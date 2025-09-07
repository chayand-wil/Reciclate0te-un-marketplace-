<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // //        Schema::create('notificacion_usuario', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('id_usuario')->constrained('users');
    //         $table->foreignId('id_publicacion')->constrained('publicacion');
    //         $table->foreignId('id_motivo_notificacion')->constrained('motivo_notificacion');
    //         $table->timestamps();
    //     });
    protected $table = 'notificacion_usuario';
    protected $primaryKey = 'id';   
    public $timestamps = true; // Si la tabla tiene columnas created_at y updated_at
    protected $fillable = [
        'id_usuario',
        'id_publicacion',
        'id_motivo_notificacion',
    ];

 
     public function motivoNotificacion()
    {
        return $this->belongsTo(MotivoNotificacion::class, 'id_motivo_notificacion');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'id_publicacion');
    }
}