<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

    public function show(Categoria $categoria)
    {
        return $categoria;
    }

    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;

        $categoria->save();
        return response()->json([
            'mensaje' => 'Categoria creada exitosamente',
            'categoria' => $categoria,
        ], 201);
    }

    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->nombre = $request->nombre;

        $categoria->save();
        return response()->json([
            'mensaje' => 'Categoria actualizada exitosamente',
            'categoria' => $categoria,
        ], 204);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json([
            'mensaje' => 'Categoria eliminada exitosamente',
        ], 204);
    }
}
