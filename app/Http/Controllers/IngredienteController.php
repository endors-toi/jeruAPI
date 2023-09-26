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
        return Ingrediente::all();
    }

    public function show(Ingrediente $ingrediente)
    {
        return $ingrediente;
    }

    public function store(IngredienteRequest $request)
    {
        $ingrediente = new Ingrediente();
        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad_disponible = $request->cantidad_disponible;
        $ingrediente->cantidad_critica = $request->cantidad_critica;
        $ingrediente->save();

        return response()->json([
            'mensaje' => 'Ingrediente creado exitosamente',
            'ingrediente' => $ingrediente,
        ], 201);
    }

    public function update(IngredienteRequest $request, Ingrediente $ingrediente)
    {
        $ingrediente->nombre = $request->nombre;
        $ingrediente->cantidad_disponible = $request->cantidad_disponible;
        $ingrediente->cantidad_critica = $request->cantidad_critica;
        $ingrediente->save();

        return response()->json([
            'mensaje' => 'Ingrediente actualizado exitosamente',
            'ingrediente' => $ingrediente,
        ], 204);
    }

    public function destroy(Ingrediente $ingrediente)
    {
        $ingrediente->delete();
        return response()->json([
            'mensaje' => 'Ingrediente eliminado exitosamente',
        ], 200);
    }
}
