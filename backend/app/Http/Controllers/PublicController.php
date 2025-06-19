<?php

namespace App\Http\Controllers;

// use App\Models\Public;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    private $tableVisibilidades = 'publicacion_visibilidad';

                //   usada en crear publicaciones 
    public function getCatalogo(Request $request)
    {
        return DB::table($request->table)->get();
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
