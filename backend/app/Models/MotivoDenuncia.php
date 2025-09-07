<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoDenuncia extends Model
{

    protected $table = 'motivo_denuncia'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'slug',
    ];

 
}

