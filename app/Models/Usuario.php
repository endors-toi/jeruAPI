<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rol;
use App\Models\Orden;

class Usuario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'usuarios';
    public $timestamps = false;

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_usuario');
    }
}
