<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 30);
            $table->foreignId('id_categoria')->references('id')->on('categorias');
            $table->integer('precio');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Productos');
    }
};
