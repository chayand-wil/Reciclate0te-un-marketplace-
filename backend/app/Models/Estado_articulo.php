<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado_articulo extends Model
{
            protected $table = 'estado_articulo'; // Nombre de la tabla en la base de datos
        protected $primaryKey = 'id'; // Clave primaria de la tabla
        public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
        protected $fillable = [
            'id',
            'nombre',
            'slug',
        ];
        // Puedes agregar relaciones si es necesario, por ejemplo:
        public function articulos()
        {
            return $this->hasMany(Articulo::class, 'estado_articulo');
        }
}
