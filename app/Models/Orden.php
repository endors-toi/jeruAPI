<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Orden extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'ordenes';
    public $timestamps = false;

    public function usuario(){
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
