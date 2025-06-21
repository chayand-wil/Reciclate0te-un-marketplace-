<?php

namespace App\Models;

use App\Models\User;
use App\Models\Articulo;
use App\Models\Publicacion_visibilidad;
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

        // Una publicación pertenece a un usuario
        public function user()
        {
                return $this->belongsTo(User::class, 'id_usuario');
        }

        
        // Una publicación pertenece a un artículo
        public function article()
        {
                $article =  $this->belongsTo(Articulo::class, 'id_articulo');
                $article->with(['categoria', 'tipoPublico', 'calidadArticulo', 'estadoArticulo', 'estadoAdquisicion']);
                return $article;
        }


        // DB::table('articulo_estado_adquisicion')->insert([
        //     ['nombre' => 'Disponible', 'slug' => 'disponible'],
        //     ['nombre' => 'Solicitado-disponible', 'slug' => 'solicitado-disponibe'],
        //     ['nombre' => 'En proceso de intercambio', 'slug' => 'intecambio'],
        //     ['nombre' => 'Intercambio completado', 'slug' => 'completado'],
        // ]);

        // publicaiones 

        // Una publicación tiene una visibilidad
        public function visibility()
        {
                //esta funcion retorna la visibilidad de la publicacion
                //es decir, retorna el id_publicacion_visibilidad de la tabla publicacion_visibilidad
                //que corresponde a esta publicacion
                //por lo tanto, retorna el objeto Publicacion_visibilidad
                return $this->belongsTo(Publicacion_visibilidad::class, 'id_publicacion_visibilidad');
        }
}
