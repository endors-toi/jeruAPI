<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;


Route::resource('productos', ProductoController::class)->only(['index','show','store','destroy','update']);
Route::resource('ingredientes', IngredienteController::class)->only(['index','show','store','destroy','update']);
Route::resource('ordenes', OrdenController::class)->only(['index','show','store','destroy','update'])->parameters(['ordenes' => 'orden']);
Route::resource('categorias', CategoriaController::class)->only(['index','show','store','destroy','update']);
Route::resource('usuarios', UsuarioController::class)->only(['index','show','store','destroy','update']);

