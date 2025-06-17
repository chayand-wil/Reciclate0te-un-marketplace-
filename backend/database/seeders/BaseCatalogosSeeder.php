<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseCatalogosSeeder extends Seeder
{
    public function run(): void
    {
        
        DB::table('role_users')->insert([
            ['nombre' => 'Administrador', 'slug' => 'admin'],
            ['nombre' => 'Administrador de punto de acopio', 'slug' => 'bodeguero'],
            ['nombre' => 'Administrador Clasificador', 'slug' => 'clasificador'],
            ['nombre' => 'Reutilizador', 'slug' => 'reutilizador'],
            ['nombre' => 'Ecoemprendedor', 'slug' => 'ecomemprendedor'],
        ]);

        DB::table('estado_usuario')->insert([
            ['estado' => 'activo'],
            ['estado' => 'inactivo'],
            ['estado' => 'baneado']
        ]);

        DB::table('nivel')->insert([
            ['nombre_nivel' => 'Inicial', 'descripcion' => 'Nivel básico', 'puntos_necesarios' => 0],
            ['nombre_nivel' => 'Intermedio', 'descripcion' => 'Nivel medio', 'puntos_necesarios' => 100],
            ['nombre_nivel' => 'Avanzado', 'descripcion' => 'Nivel alto', 'puntos_necesarios' => 300]
        ]);

        DB::table('estado_solicitud')->insert([
            ['estado' => 'pendiente', 'slug' => 'pendiente'],
            ['estado' => 'aprobada', 'slug' => 'aprobada'],
            ['estado' => 'rechazada', 'slug' => 'rechazada']
        ]);

        DB::table('categoria_articulo')->insert([
            ['descripcion' => 'Plástico'],
            ['descripcion' => 'Vidrio'],
            ['descripcion' => 'Metal'],
            ['descripcion' => 'Cartón']
        ]);

        DB::table('tipo_publico')->insert([
            ['tipo' => 'General'],
            ['tipo' => 'Solo registrados']
        ]);

        DB::table('calidad_articulo')->insert([
            ['calidad' => 'Buena', 'slug' => 'buena'],
            ['calidad' => 'Regular', 'slug' => 'regular'],
            ['calidad' => 'Mala', 'slug' => 'mala']
        ]);

        DB::table('estado_articulo')->insert([
            ['estado' => 'Disponible', 'slug' => 'disponible'],
            ['estado' => 'Entregado', 'slug' => 'entregado'],
            ['estado' => 'Reservado', 'slug' => 'reservado']
        ]);

        DB::table('articulo_estado_adquisicion')->insert([
            ['estado_adquisicion' => 'Disponible', 'slug' => 'disponible'],
            ['estado_adquisicion' => 'Solicitado', 'slug' => 'solicitado'],
            ['estado_adquisicion' => 'Entregado', 'slug' => 'entregado']
        ]);

        DB::table('publicacion_visibilidad')->insert([
            ['visibilidad' => 'Pública'],
            ['visibilidad' => 'Solo usuarios registrados']
        ]);

        DB::table('motivo_denuncia')->insert([
            ['motivo' => 'Contenido ofensivo'],
            ['motivo' => 'Información falsa'],
            ['motivo' => 'Incitación al odio'],
            ['motivo' => 'Otro']
        ]);

        DB::table('estado_denuncia')->insert([
            ['estado' => 'pendiente'],
            ['estado' => 'resuelta'],
            ['estado' => 'descartada']
        ]);

        DB::table('habilidad')->insert([
            ['descripcion' => 'Reutilización creativa', 'slug' => 'reutilizacion-creativa'],
            ['descripcion' => 'Clasificación de materiales', 'slug' => 'clasificacion-materiales'],
            ['descripcion' => 'Transformación de residuos', 'slug' => 'transformacion-residuos']
        ]);

        DB::table('insignias')->insert([
            ['nombre' => 'Recolector novato', 'descripcion' => 'Primeros pasos en reciclaje'],
            ['nombre' => 'Ecohéroe', 'descripcion' => 'Has ayudado a muchas personas'],
            ['nombre' => 'Clasificador experto', 'descripcion' => 'Dominio en clasificación de materiales']
        ]);

        DB::table(('pais'))->insert([
            ['nombre' => 'Guatemala'],
        ]);
        DB::table(('departamento'))->insert([
            ['nombre' => 'quetzaltenango', 'id_pais' => '1'],
        ]);
        DB::table(('municipio'))->insert([
            ['nombre' => 'Salcaja', 'id_departamento' => '1'],
            ['nombre' => 'Almolonga', 'id_departamento' => '1'],
            ['nombre' => 'Cantel', 'id_departamento' => '1'],
            ['nombre' => 'Quetzaltenango', 'id_departamento' => '1'],
        ]);


    }
}
