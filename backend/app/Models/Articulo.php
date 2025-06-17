<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = 'articulo'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = false; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
        'id',
        'nombre',
        'descripcion',
        'detalles',
        'id_categoria_articulo',
        'id_tipo_publico',
        'calidad_articulo',
        'estado_articulo',
        'id_articulo_estado_adquisicion',

    ];

 
        // Schema::create('articulo', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('nombre', 100);
        //     $table->text('descripcion');
        //     $table->text('detalles');
        //     $table->foreignId('id_categoria_articulo')->constrained('categoria_articulo');
        //     $table->foreignId('id_tipo_publico')->constrained('tipo_publico');
        //     $table->foreignId('calidad_articulo')->constrained('calidad_articulo');
        //     $table->foreignId('estado_articulo')->constrained('estado_articulo');
        //     $table->foreignId('id_articulo_estado_adquisicion')->constrained('articulo_estado_adquisicion');
        // });


}
