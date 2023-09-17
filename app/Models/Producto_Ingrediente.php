<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoIngrediente extends Model
{
    use HasFactory;

    protected $table = 'producto_ingredientes';
    public $timestamps = false;
}
