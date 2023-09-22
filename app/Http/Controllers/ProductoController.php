<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return response()->json([
            'productos' => $productos,
        ], 200);
    }

    public function show(int $id)
    {
        try {
            $producto = Producto::with('categoria')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Producto no encontrado',
            ], 404);
        }

        return response()->json([
            'producto' => $producto,
        ], 200);
    }

    public function store(ProductoRequest $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->id_categoria;
        $producto->precio = $request->precio;

        $producto->save();
        return response()->json([
            'mensaje' => 'Producto creado exitosamente',
            'producto' => $producto,
        ], 201);
    }

    public function update(ProductoRequest $request, int $id)
    {
        try {
            $producto = Producto::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Producto no encontrado',
            ], 404);
        }

        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->id_categoria;
        $producto->precio = $request->precio;

        $producto->save();
        return response()->json([
            'mensaje' => 'Producto actualizado exitosamente',
            'producto' => $producto,
        ], 204);
    }

    public function destroy(int $id)
    {
        $producto = Producto::find($id);
        if (!$producto) {
            return response()->json([
                'mensaje' => 'Producto no encontrado',
            ], 404);
        }

        $producto->delete();
        return response()->json([
            'mensaje' => 'Producto eliminado exitosamente',
        ], 204);
    }
}
