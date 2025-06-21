<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    protected $table = 'estado_solicitud'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'slug',
    ];
    
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'id_estado_solicitud');
    }

        //     DB::table('estado_solicitud')->insert([
        //     ['nombre' => 'Sin revisión', 'slug' => 'pendiente'],
        //     ['nombre' => 'Aceptada', 'slug' => 'aceptada'],
        //     ['nombre' => 'Ignorada', 'slug' => 'ignorada']
        // ]);
    public function solicitudesPendientes()
    {
        return $this->hasMany(Solicitud::class, 'id_estado_solicitud')->where('id_estado_solicitud', 1);
    }

    public function solicitudesAceptadas()
    {
        return $this->hasMany(Solicitud::class, 'id_estado_solicitud')->where('id_estado_solicitud', 2);
    } 
    public function solicitudesIgnoradas()
    {
        return $this->hasMany(Solicitud::class, 'id_estado_solicitud')->where('id_estado_solicitud', 3);
    }
}
