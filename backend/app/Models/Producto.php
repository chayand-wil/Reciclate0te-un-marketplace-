<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //

    protected $table = 'producto'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'cantidad',
        'nombre'
    ];
    


}
