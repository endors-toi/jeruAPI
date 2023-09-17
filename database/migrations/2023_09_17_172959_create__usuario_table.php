<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_rol')->references('id')->on('roles');
            $table->string('nombre', 20);
            $table->string('apellido', 20);
            $table->string('nombre_usuario', 20)->unique();
            $table->string('contrasena', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Usuarios');
    }
};
