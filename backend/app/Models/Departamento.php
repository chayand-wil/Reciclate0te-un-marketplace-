<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    //

    protected $table = 'departamento'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'id_departamento',
    ]; 

    public function getAllMunicipios()
    {
        return $this->all();
    }
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento', 'id');
    }
 

     
}
