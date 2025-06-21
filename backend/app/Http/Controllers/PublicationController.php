<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Articulo;
use Illuminate\Http\Request;

class PublicationController extends Controller
{

    // Schema::create('publicacion', function (Blueprint $table) {
    //     $table->foreignId('id_usuario')->constrained('users')->onDelete('cascade');
    //     $table->foreignId('id_articulo')->constrained('articulo');
    //     $table->text('imagen_url');
    //     $table->foreignId('id_publicacion_visibilidad')->constrained('publicacion_visibilidad');
    //     $table->unsignedInteger('cantidad_visualizaciones')->default(0);
    //     $table->timestamps();
    // });


    public function getPublication()
    {
        $id = request()->route('id');
        $publication = Publication::find($id);

        if (!$publication) {
            return response()->json(['message' => 'Publicación no encontrada'], 404);
        }
        return response()->json($publication->load(['user', 'article']));
    }


    public function cargarCatalogos() {}

    public function getPubs($id)
    {
        $publications = Publication::where('id_usuario', $id)->get();

        if ($publications->isEmpty()) {
            return response()->json(['message' => 'No se cuentan con publicaciones'], 404);
        }
        return response()->json($publications->load('article'));
    }

    public function index()
    {
        return Publication::all()->load([
            'user',
            'article',
        ]);
    }



    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_usuario' => 'required|integer|exists:users,id',
                'id_articulo' => 'required|integer|exists:articulo,id',
                'imagen_url' => 'required|string',
                'id_publicacion_visibilidad' => 'required|integer|exists:publicacion_visibilidad,id',
            ]);

            $publicacion = Publication::create($data);

            return response()->json([
                'message' => 'Publicacion creada exitosamente',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear publicación',
                'error' => $e->getMessage(),   // 👈 esto es clave
            ], 500);
        }
    }






    public function show(Publication $publication)
    {
        //
    }


    public function update(Request $request, Publication $publication)
    {
        //
    }

    public function destroy(Publication $publication)
    {
        //
    }
}
