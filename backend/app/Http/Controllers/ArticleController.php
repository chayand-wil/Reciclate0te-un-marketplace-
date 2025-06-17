<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
 
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

    public function index()
    {
        //
    }

    public function store(){
        // Validar los datos de entrada
        $data = request()->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'required|string|max:255',
            'detalles' => 'nullable|string',
            'id_categoria_articulo' => 'required|exists:categoria_articulo,id',
            'id_tipo_publico' => 'required|exists:tipo_publico,id',
            'calidad_articulo' => 'required|exists:calidad_articulo,id',
            'estado_articulo' => 'required|exists:estado_articulo,id',
            'id_articulo_estado_adquisicion' => 'required|exists:articulo_estado_adquisicion,id',
        ]);


        // Crear un nuevo artículo
        $articulo = Articulo::create($data);
        
        $lastId = $articulo->id;
        return response()->json([
            'message' => 'Artículo creado exitosamente',
            'id' => $lastId
        ], 201);
    
    }


 
    public function show(Articulo $articulo)
    {
        //
    }

 
    public function update(Request $request, Articulo $articulo)
    {
        //
    }

    public function destroy(Articulo $articulo)
    {
        //
    }
}
