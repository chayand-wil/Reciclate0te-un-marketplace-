<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calidad_articulo extends Model
{
      
        protected $table = 'calidad_articulo'; // Nombre de la tabla en la base de datos
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
            return $this->hasMany(Articulo::class, 'id_calidad_articulo');
        }

        
}
