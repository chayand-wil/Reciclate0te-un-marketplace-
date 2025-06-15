<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //

    protected $table = 'role_users'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'rol',
        'slug',
    ];
    

        // Relación: Un rol tiene muchos usuarios
        // Laravel ejecuta automáticamente una consulta a la base de datos 
        // para obtener todos los User donde id_rol sea igual al ID del rol actual.
    public function usuarios()
    {
        return $this->hasMany(User::class, 'id_rol');
    }


}
