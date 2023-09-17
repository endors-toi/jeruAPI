<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('producto_ingrediente', function (Blueprint $table) {
            $table->foreignId('id_producto')->references('id')->on('productos');
            $table->foreignId('id_ingrediente')->references('id')->on('ingredientes');
            $table->integer('cantidad');
            $table->primary(['id_producto', 'id_ingrediente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProductoIngredientes');
    }
};
