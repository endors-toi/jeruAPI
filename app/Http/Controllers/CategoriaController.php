<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return response()->json([
            'categorias' => $categorias,
        ], 200);
    }

    public function show(int $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Categoria no encontrada',
            ], 404);
        }

        return response()->json([
            'categoria' => $categoria,
        ], 200);
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

    public function update(CategoriaRequest $request, int $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Categoria no encontrada',
            ], 404);
        }

        $categoria->nombre = $request->nombre;

        $categoria->save();
        return response()->json([
            'mensaje' => 'Categoria actualizada exitosamente',
            'categoria' => $categoria,
        ], 204);
    }

    public function destroy(int $id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            return response()->json([
                'mensaje' => 'Categoria no encontrada',
            ], 404);
        }

        $categoria->delete();
        return response()->json([
            'mensaje' => 'Categoria eliminada exitosamente',
        ], 204);
    }
}
