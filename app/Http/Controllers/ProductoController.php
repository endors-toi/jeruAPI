<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\ProductoRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function show(Producto $producto)
    {
        return $producto;
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

    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->id_categoria;
        $producto->precio = $request->precio;

        $producto->save();
        return response()->json([
            'mensaje' => 'Producto actualizado exitosamente',
            'producto' => $producto,
        ], 204);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json([
            'mensaje' => 'Producto eliminado exitosamente',
        ], 204);
    }
}
