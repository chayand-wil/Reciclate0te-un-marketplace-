<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReporteBodega extends Model
{
    protected $table = 'reporte_bodega'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; // Clave primaria de la tabla
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id_solicitud',
        'id_estado_verificado',
        'id_user_bodeguero',
        'id_tipo_reporte',
        'observaciones_del_receptor',
    ];
    
    // Puedes agregar relaciones si es necesario, por ejemplo:
    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'id_solicitud');
    }


}
