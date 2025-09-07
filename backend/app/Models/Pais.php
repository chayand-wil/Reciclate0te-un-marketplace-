<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    //

    protected $table = 'pais'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre'
    ]; 
 

    
     
}
