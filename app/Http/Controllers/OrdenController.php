<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Http\Requests\OrdenRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrdenController extends Controller
{
    public function index()
    {
        return Orden::all();
    }

    public function show(Orden $orden)
    {
        return $orden;
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

    public function update(OrdenRequest $request, Orden $orden)
    {
        $orden->id_usuario = $request->id_usuario;
        $orden->estado = $request->estado;
        $orden->nombre_cliente = $request->nombre_cliente;

        $orden->save();
        return response()->json([
            'mensaje' => 'Orden actualizada exitosamente',
            'orden' => $orden,
        ], 204);
    }

    public function destroy(Orden $orden)
    {
        $orden->delete();
        return response()->json([
            'mensaje' => 'Orden eliminada exitosamente',
        ], 204);
    }
}
