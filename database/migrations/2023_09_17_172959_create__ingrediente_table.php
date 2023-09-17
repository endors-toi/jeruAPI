<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 20);
            $table->integer('cantidad_disponible');
            $table->integer('cantidad_critica');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Ingredientes');
    }
};
