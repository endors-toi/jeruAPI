<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioController extends Controller
{
    /* (!!) Es posible que debamos hacer try-catch en cada save() y delete()
            para manejar errores de base de datos
    */

    public function index()
    {
        /* Retorna todos los usuarios
        */
        $usuarios = Usuario::all();
        return response()->json([
            'usuarios' => $usuarios,
        ], 200);
    }

    public function store(UsuarioRequest $request)
    {
        /* Recibe datos del usuario en formato JSON con los siguientes campos:
            nombre, apellido, nombre_usuario, contrasena, id_rol
           Devuelve error 422 si no se cumplen las validaciones
        */
        $usuario = new Usuario();
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->contrasena = bcrypt($request->contrasena);
        $usuario->id_rol = $request->id_rol;

        /* Si pasan las validaciones, se crea el usuario
            y se retorna mensaje de confirmación estándar
        */
        $usuario->save();
        return response()->json([
            'mensaje' => 'Usuario creado exitosamente',
            'usuario' => $usuario,
        ], 201);
    }

    public function show(int $id)
    {
        /* Se busca el usuario por su id,
            si no existe, retorna 404
        */
        try {
            $usuario = Usuario::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado',
            ], 404);
        }

        /* Si se encuentra el usuario,
            se retorna en formato JSON
        */
        return response()->json([
            'usuario' => $usuario,
        ], 200);
    }

    public function update(UsuarioRequest $request, int $id)
    {
        /* Se busca el usuario por su id,
            si no existe, retorna 404
        */
        try {
            $usuario = Usuario::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado',
            ], 404);
        }

        /* Recibe y realiza cambios en el usuario en formato JSON con los siguientes campos:
            nombre, apellido, nombre_usuario, contrasena, id_rol
           Devuelve error 422 si no se cumplen las validaciones
        */
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_usuario = $request->nombre_usuario;
        $usuario->contrasena = bcrypt($request->contrasena);
        $usuario->id_rol = $request->id_rol;

        /* Si pasan las validaciones, se actualiza el usuario.
        */
        $usuario->save();
        return response()->json([
            'mensaje' => 'Usuario actualizado exitosamente',
            'usuario' => $usuario,
        ], 200);
    }

    public function destroy(int $id)
    {
        /* Se busca el usuario por su id,
            si no existe, se retorna error 404
        */
        $usuario = Usuario::find($id);
        if (!$usuario) {
            return response()->json([
                'mensaje' => 'Usuario no encontrado',
            ], 404);
        }

        /* Si se encuentra el usuario,
            se elimina y se retorna mensaje de confirmación estándar
        */
        $usuario->delete();
        return response()->json([
            'mensaje' => 'Usuario eliminado exitosamente',
        ], 204);
    }
}
