<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orden_producto', function (Blueprint $table) {
            $table->foreignId('id_orden')->constrained('ordenes');
            $table->foreignId('id_producto')->constrained('productos');
            $table->integer('cantidad');
            $table->primary(['id_orden', 'id_producto']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('OrdenProductos');
    }
};
