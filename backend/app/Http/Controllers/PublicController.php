<?php

namespace App\Http\Controllers;

// use App\Models\Public;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    private $tableVisibilidades = 'publicacion_visibilidad';

    //   usada en crear publicaciones 
    /**
     * Get the catalog data.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCatalogoArticles()
    {
        $catalogo = [
            'categoria_articulo' => DB::table('categoria_articulo')->get(),
            'tipo_publico'     => DB::table('tipo_publico')->get(),
            'calidad_articulo'          => DB::table('calidad_articulo')->get(),
            'estado_articulo'      => DB::table('estado_articulo')->get(),
            'articulo_estado_adquisicion'      => DB::table('articulo_estado_adquisicion')->get(),
            'municipio'      => DB::table('municipio')->get(),
        ];

        return response()->json($catalogo);
    }

    public function getTableById($id, $table){
        $item = DB::table($table)->where('id', $id)->first();
        return response()->json($item);
    }




    public function getCatalogo($table)
    {
        $item = DB::table($table)->get();
        return response()->json($item);
    }


    

    public function getVisibilidades()
    {
        return DB::table($this->tableVisibilidades)->get();
    }
    public function get()
    {
        return DB::table($this->tableVisibilidades)->get();
    }
}

// return DB::table('publicacion_visibilidad')->select('id', 'nombre')->get();



// return DB::table('publicacion_visibilidad')
//     ->select('id', 'nombre')
//     ->where('activo', 1)
//     ->get();
