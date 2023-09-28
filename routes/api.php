<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;



Route::post('/login', [UsuarioController::class, 'login']);
Route::apiResource('/usuarios', UsuarioController::class);

// Admin
Route::middleware(['role:admin'])->group(function () {
    Route::apiResource('ordenes', OrdenController::class)->parameters(['ordenes'=>'orden']);
    Route::apiResource('ingredientes', IngredienteController::class);
    Route::apiResource('categorias', CategoriaController::class);
    Route::apiResource('productos', ProductoController::class);
    // Route::apiResource('usuarios', UsuarioController::class);
});

// Cajero
Route::middleware(['role:cajero'])->group(function () {
    Route::apiResource('ordenes', OrdenController::class)->except(['destroy'])->parameters(['ordenes'=>'orden']);
    Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);
    Route::apiResource('categorias', CategoriaController::class)->only(['index', 'show']);
    Route::apiResource('ingredientes', IngredienteController::class)->only(['index', 'show']);
});

// Garzon
Route::middleware(['role:garzon'])->group(function () {
    Route::apiResource('ordenes', OrdenController::class)->only(['index', 'show', 'store'])->parameters(['ordenes'=>'orden']);
    Route::apiResource('productos', ProductoController::class)->only(['index', 'show']);
    Route::apiResource('categorias', CategoriaController::class)->only(['index', 'show']);
});

// Cocina
Route::middleware(['role:cocina'])->group(function () {
    Route::apiResource('ordenes', OrdenController::class)->only(['index', 'show', 'update'])->parameters(['ordenes'=>'orden']);
    Route::apiResource('ingredientes', IngredienteController::class)->only(['index', 'show']);
});

