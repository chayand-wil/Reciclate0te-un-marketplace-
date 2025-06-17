<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publicacion'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'id'; //
    public $timestamps = true; // Si la tabla no tiene columnas created_at y updated_at
    protected $fillable = [
            'id' => '',
            'id_usuario',
            'id_articulo',
            'imagen_url',
            'id_publicacion_visibilidad',
    ];


        // Schema::create('publicacion', function (Blueprint $table) {
        //     $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
        //     $table->foreignId('id_articulo')->constrained('articulo');
        //     $table->text('imagen_url');
        //     $table->foreignId('id_publicacion_visibilidad')->constrained('publicacion_visibilidad');
        //     $table->unsignedInteger('cantidad_visualizaciones')->default(0);
        //     $table->timestamps();
        // });




}
