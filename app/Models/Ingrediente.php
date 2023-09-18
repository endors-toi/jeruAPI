<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Ingrediente extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'ingredientes';
    public $timestamps = false;

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_ingrediente', 'id_ingrediente', 'id_producto')
                    ->with_pivot('cantidad');
    }
}
