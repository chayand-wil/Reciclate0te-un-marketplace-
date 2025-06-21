<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacion_visibilidad extends Model
{
    protected $table = 'publicacion_visibilidad'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'slug',
    ];
    
    // Puedes agregar relaciones si es necesario, por ejemplo:
    public function publicaciones()
    {
        //esta funcion retorna todas las publicaciones que tienen esta visibilidad
        //es decir, todas las publicaciones que tienen este id_publicacion_visibilidad
        //en la tabla publicacion
        return $this->hasMany(Publication::class, 'id_publicacion_visibilidad');
    }

}