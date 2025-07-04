<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado_Adquicision extends Model
{

    protected $table = 'articulo_estado_adquisicion'; // Nombre de la tabla en la base de datos
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
        return $this->hasMany(Articulo::class, 'id_articulo_estado_adquisicion');
    }

    // Puedes agregar otros métodos o relaciones según sea necesario
    public function publicaciones()
    {
        $pub = $this->hasMany(Publication::class, 'id_estado_adquisicion')->with(['article', 'user']);
        return $pub;

    }

}

