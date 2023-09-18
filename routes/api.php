<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\ProductoIngredienteController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\OrdenProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;

Route::resource('producto', ProductoController::class);
Route::resource('ingrediente', IngredienteController::class);
Route::resource('producto_ingrediente', ProductoIngredienteController::class);
Route::resource('orden', OrdenController::class);
Route::resource('orden_producto', OrdenProductoController::class);
Route::resource('categoria', CategoriaController::class);
Route::resource('usuario', UsuarioController::class)->only(['index','show','store','update','destroy']);
