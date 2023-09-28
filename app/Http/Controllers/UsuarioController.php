<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsuarioController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->only('nombre_usuario', 'contrasena');

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'mensaje' => 'Credenciales inválidas',
            ], 401);
        };

        $usuario = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();

        return response()->json([
            'user' => $usuario,
            'token' => $token,
        ]);
    }

    public function index()
    {
        /* Retorna todos los Usuarios
        */
        return Usuario::all();
    }

    public function show(Usuario $usuario)
    {
        /* Se retorna Usuario obtenido de la ID en la URL.
           Si Laravel falla en inyectar el modelo, retorna 404
        */
        return $usuario;
    }

    public function store(UsuarioRequest $request)
    {
        /* Laravel traduce el JSON recibido y lo pasa por el UsuarioRequest.
           Devuelve error 422 si no se cumplen las validaciones.
        */
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $this->generarUsername($request->nombre, $request->apellido);
        $usuario->contrasena = bcrypt($request->contrasena);
        $usuario->id_rol = $request->id_rol;

        /* Si pasan las validaciones, se crea el usuario
           y se retorna mensaje de confirmación estándar + el usuario creado
        */
        $usuario->save();
        return response()->json([
            'mensaje' => 'Usuario creado exitosamente',
            'usuario' => $usuario,
        ], 201);
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        /* Manera alternativa de realizar update.
            Revisa campo por campo si existen cambios a través de $changed.
            Determina si se debe regenerar el nombre de usuario a través de $nameChanged.
        */

        $changed = false;
        $nameChanged = false;

        if ($usuario->nombre !== $request->nombre) {
            $usuario->nombre = $request->nombre;
            $changed = true;
            $nameChanged = true;
        }

        if ($usuario->apellido !== $request->apellido) {
            $usuario->apellido = $request->apellido;
            $changed = true;
            $nameChanged = true;
        }

        if ($nameChanged) {
            $usuario->nombre_usuario = $this->generarUsername($request->nombre, $request->apellido);
        }

        if (!Hash::check($request->contrasena, $usuario->contrasena)) {
            $usuario->contrasena = bcrypt($request->contrasena);
            $changed = true;
        }

        if ($usuario->id_rol !== $request->id_rol) {
            $usuario->id_rol = $request->id_rol;
            $changed = true;
        }

        /* Si se detectaron cambios, se realiza save().
        */
        if ($changed) {
            $usuario->save();
            return response()->json([
                'mensaje' => 'Usuario actualizado exitosamente',
                'usuario' => $usuario,
            ], 204);
        } else {
            return response()->json([
                'mensaje' => 'No se detectaron cambios en el usuario',
                'usuario' => $usuario,
            ], 200);
        }
    }


    public function destroy(Usuario $usuario)
    {
        /* Se elimina el Usuario correspondiente
            al ID presente en la URL (si existe)
        */
        $usuario->delete();
        return response()->json([
            'mensaje' => 'Usuario eliminado exitosamente',
        ], 204);
    }

    private function generarUsername($nombre, $apellido){
        /* Limpia nombre y apellido
        */
        $nombre = str_replace('ñ', 'n', $nombre);
        $apellido = str_replace('ñ', 'n', $apellido);
        $nombre = strtolower(preg_replace('/[^\p{L}\-]/u', '', $nombre));
        $apellido = strtolower(preg_replace('/[^\p{L}\-]/u', '', $apellido));

        /* Genera nombre de usuario en este formato: nombre_apellido
            Si ya existe, se le agrega un número correlacional al final
        */
        $usuarioBase = strtolower($nombre . '_' . $apellido);
        $usuario = $usuarioBase;
        $i = 1;
        while (Usuario::where('nombre_usuario', $usuario)->exists()) {
            $usuario = $usuarioBase . $i;
            $i++;
        }

        return $usuario;
    }
}
