<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DenunciaProfile extends Model
{

    protected $table = 'denuncia_usuario'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'id_usuario_denunciado',
        'id_usuario_denunciante',
        'id_motivo_denuncia',
        'id_estado_denuncia',
    ];

    public function usuarioDenunciado()
    {
        return $this->belongsTo(User::class, 'id_usuario_denunciado');
    }
    public function usuarioDenunciante()
    {
        return $this->belongsTo(User::class, 'id_usuario_denunciante');
    }
    public function motivoDenuncia()
    {
        return $this->belongsTo(MotivoDenuncia::class, 'id_motivo_denuncia');
    }
    public function estadoDenuncia()
    {
        return $this->belongsTo(EstadoDenuncia::class, 'id_estado_denuncia');
    }   
}


