<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{

    protected $table = 'denuncia_publicacion'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'id_usuario',
        'id_publicacion',
        'id_motivo_denuncia',
        'id_estado_denuncia',
    ];

    //solicitedes 
   
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function publicacion()
    {
        return $this->belongsTo(Publication::class, 'id_publicacion');
    }
    public function motivoDenuncia(){
        return $this->belongsTo(MotivoDenuncia::class, 'id_motivo_denuncia');
    }
    public function estadoDenuncia(){
        return $this->belongsTo(EstadoDenuncia::class, 'id_estado_denuncia');
    }

}
