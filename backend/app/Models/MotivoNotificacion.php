<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MotivoNotificacion extends Model
{
    // //        Schema::create('notificacion_usuario', function (Blueprint $table) {
    //         $table->id();
    //         $table->foreignId('id_usuario')->constrained('users');
    //         $table->foreignId('id_publicacion')->constrained('publicacion');
    //         $table->foreignId('id_motivo_notificacion')->constrained('motivo_notificacion');
    //         $table->timestamps();
    //     });
    protected $table = 'motivo_notificacion';
    protected $primaryKey = 'id';   
    public $timestamps = false; // Si la tabla tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'slug',
    ];


    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_motivo_notificacion');
    }
    //retornar esta clase

    public function getRouteKeyName()
    {
        // return self::slug
    }
}
