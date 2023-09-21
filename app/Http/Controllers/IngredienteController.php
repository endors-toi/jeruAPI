<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Http\Requests\IngredienteRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class IngredienteController extends Controller
{
    public function index()
    {
        /* Retorna todos los ingredientes
        */
        $ingredientes = Ingrediente::all();
        return response()->json([
            'ingredientes' => $ingredientes,
        ], 200);
    }

    public function show(string $id)
    {
        /* Se busca el ingrediente por su id,
            si no existe, retorna 404
        */
        try {
            $ingrediente = Ingrediente::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Ingrediente no encontrado',
            ], 404);
        }

        /* Si se encuentra el ingrediente,
            se retorna en formato JSON
        */
        return response()->json([
            'ingrediente' => $ingrediente,
        ], 200);
    }

    public function store(IngredienteRequest $request)
    {
        /* Recibe datos del ingrediente en formato JSON con los siguientes campos:
            nombre, cantidad_disponible, cantidad_critica
           Devuelve error 422 si no se cumplen las validaciones
        */
        $ingrediente = new Ingrediente();
        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad_disponible = $request->cantidad_disponible;
        $ingrediente->cantidad_critica = $request->cantidad_critica;

        /* Si pasan las validaciones, se crea el usuario
            y se retorna mensaje de confirmación estándar
        */
        $ingrediente->save();
        return response()->json([
            'mensaje' => 'Ingrediente creado exitosamente',
            'ingrediente' => $ingrediente,
        ], 201);
    }

    public function update(IngredienteRequest $request, string $id)
    {
        /* Recibe datos del ingrediente en formato JSON con los siguientes campos:
            nombre, cantidad_disponible, cantidad_critica
           Devuelve error 422 si no se cumplen las validaciones
        */
        try {
            $ingrediente = Ingrediente::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Ingrediente no encontrado',
            ], 404);
        }

        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad_disponible = $request->cantidad_disponible;
        $ingrediente->cantidad_critica = $request->cantidad_critica;

        /* Si pasan las validaciones, se crea el usuario
            y se retorna mensaje de confirmación estándar
        */
        $ingrediente->save();
        return response()->json([
            'mensaje' => 'Ingrediente actualizado exitosamente',
            'ingrediente' => $ingrediente,
        ], 204);
    }

    public function destroy(string $id)
    {
        /* Se busca el ingrediente por su id,
            si no existe, retorna 404
        */
        try {
            $ingrediente = Ingrediente::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Ingrediente no encontrado',
            ], 404);
        }

        /* Si se encuentra el ingrediente,
            se elimina y se retorna mensaje de confirmación estándar
        */
        $ingrediente->delete();
        return response()->json([
            'mensaje' => 'Ingrediente eliminado exitosamente',
        ], 200);
    }
}
