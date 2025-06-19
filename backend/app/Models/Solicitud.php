<?php

namespace App\Models;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{

    protected $table = 'articulo_solicitud';
    public $primaryKey = 'id';
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'id_estado_solicitud',
        'id_publicacion',
        'id_usuario_nuevo',
    ];

    //     Schema::create('articulo_solicitud', function (Blueprint $table) {
    //     $table->id();
    //     $table->foreignId('id_estado_adquisicion')->constrained('articulo_estado_adquisicion');
    //     $table->foreignId('id_publicacion')->constrained('publicacion');
    //     $table->foreignId('id_usuario_nuevo')->constrained('users')->onDelete('cascade');
    //     $table->dateTime('fecha_solicitado');
    // });

    // public function estadoAdquisicion()
    // {
    //     return $this->belongsTo(EstadoAdquisicion::class, 'id_estado_adquisicion');
    // }

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'id_publicacion');
    }

    public function userSolicitud()
    {
        return $this->belongsTo(User::class, 'id_usuario_nuevo');
    }
    

}
