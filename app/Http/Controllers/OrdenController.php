<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Http\Requests\OrdenRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('usuario')->get();
        return response()->json([
            'ordenes' => $ordenes,
        ], 200);
    }

    public function show(int $id)
    {
        try {
            $orden = Orden::with('usuario')->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Orden no encontrada',
            ], 404);
        }

        return response()->json([
            'orden' => $orden,
        ], 200);
    }

    public function store(OrdenRequest $request)
    {
        $orden = new Orden();
        $orden->id_usuario = $request->id_usuario;
        $orden->estado = $request->estado;
        $orden->nombre_cliente = $request->nombre_cliente;

        $orden->save();
        return response()->json([
            'mensaje' => 'Orden creada exitosamente',
            'orden' => $orden,
        ], 201);
    }

    public function update(OrdenRequest $request, int $id)
    {
        try {
            $orden = Orden::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'mensaje' => 'Orden no encontrada',
            ], 404);
        }

        $orden->id_usuario = $request->id_usuario;
        $orden->estado = $request->estado;
        $orden->nombre_cliente = $request->nombre_cliente;

        $orden->save();
        return response()->json([
            'mensaje' => 'Orden actualizada exitosamente',
            'orden' => $orden,
        ], 204);
    }

    public function destroy(int $id)
    {
        $orden = Orden::find($id);
        if (!$orden) {
            return response()->json([
                'mensaje' => 'Orden no encontrada',
            ], 404);
        }

        $orden->delete();
        return response()->json([
            'mensaje' => 'Orden eliminada exitosamente',
        ], 204);
    }
}
