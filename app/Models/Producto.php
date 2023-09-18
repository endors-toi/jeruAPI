<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Orden;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'productos';
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'producto_ingrediente', 'id_producto', 'id_ingrediente')
                    ->with_pivot('cantidad');

    }

    public function ordenes()
    {
        return $this->belongsToMany(Orden::class, 'orden_producto', 'id_producto', 'id_orden')
                    ->with_pivot('cantidad')
                    ->withTimestamps();
    }
}
