<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    protected $table = 'genero'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'slug',
    ];

     //devolver todos los géneros
    public static function getAllGeneros()
    {
        return self::all();
    }

    // Definición de la relación con el modelo User
    public function users()
    {
        return $this->hasMany(User::class, 'id_genero');
    }

    

    // Definición de la relación con el modelo User
    public function publicaciones()
    {
        return $this->hasMany(Publication::class, 'id_genero');
    }
    // Definición de la relación con el modelo Articulo



    
}
