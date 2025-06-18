<?php

namespace App\Http\Controllers;

// use App\Models\Public;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{

 

    public function getCatalogo(Request $request)
    {
        return DB::table($request->table)->get();
    }
}

// return DB::table('publicacion_visibilidad')->select('id', 'nombre')->get();



// return DB::table('publicacion_visibilidad')
//     ->select('id', 'nombre')
//     ->where('activo', 1)
//     ->get();
