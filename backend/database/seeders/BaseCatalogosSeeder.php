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
            ['nombre' => 'Ecoemprendedor', 'slug' => 'ecoemprendedor'],
        ]);

        DB::table('estado_usuario')->insert([
            ['nombre' => 'Pendiente de aceptacion', 'slug' => 'pendiente'],
            ['nombre' => 'Activo', 'slug' => 'activo'],
            ['nombre' => 'Baneo parcial', 'slug' => 'parcial'],
            ['nombre' => 'Baneo permanente', 'slug' => 'permanente'],
        ]);

        DB::table('nivel')->insert([
            ['nombre_nivel' => 'Inicial', 'descripcion' => 'Nivel básico', 'puntos_necesarios' => 0],
            ['nombre_nivel' => 'Intermedio', 'descripcion' => 'Nivel medio', 'puntos_necesarios' => 100],
            ['nombre_nivel' => 'Avanzado', 'descripcion' => 'Nivel alto', 'puntos_necesarios' => 300],
        ]);

        DB::table('estado_solicitud')->insert([
            ['nombre' => 'Pendiente', 'slug' => 'pendiente'],
            ['nombre' => 'Aceptada', 'slug' => 'aceptada'],
            ['nombre' => 'Rechazada', 'slug' => 'rechazada'],
        ]);
        DB::table('genero')->insert([
            ['nombre' => 'Masculino', 'slug' => 'masculino'],
            ['nombre' => 'Femenino', 'slug' => 'femenino'],
            ['nombre' => 'Mita mita', 'slug' => 'mita_mita'],
        ]);

        DB::table('categoria_articulo')->insert([
            ['nombre' => 'Tecnología', 'slug' => 'tecno'],
            ['nombre' => 'Accesorios para hogar', 'slug' => 'para_hogar'],
            ['nombre' => 'Ropa', 'slug' => 'ropa'],
            ['nombre' => 'Mueblería', 'slug' => 'muebleria'],
            ['nombre' => 'Otro', 'slug' => 'otro'],
        ]);

        DB::table('tipo_publico')->insert([
            ['nombre' => 'Adultos', 'slug' => 'adulto'],
            ['nombre' => 'Niños', 'slug' => 'ninios'],
            ['nombre' => 'Para toda la familia', 'slug' => 'familiar'],
        ]);

        DB::table('calidad_articulo')->insert([
            ['nombre' => 'Regular', 'slug' => 'regular'],
            ['nombre' => 'Prenda artesanal', 'slug' => 'artesanal'],
            ['nombre' => 'Media', 'slug' => 'media'],
            ['nombre' => 'Marca reconocida', 'slug' => 'marca'],
        ]);

        DB::table('estado_articulo')->insert([
            ['nombre' => 'Requiere ajustes', 'slug' => 'ajustes'],
            ['nombre' => 'Aceptable', 'slug' => 'aceptable'],
            ['nombre' => 'Usado bueno', 'slug' => 'bueno'],
            ['nombre' => 'Usado como nuevo', 'slug' => 'como_nuevo'],
        ]);

        DB::table('articulo_estado_adquisicion')->insert([
            ['nombre' => 'Disponible', 'slug' => 'disponible'],
            ['nombre' => 'Solicitado-disponible', 'slug' => 'solicitado-disponibe'],
            ['nombre' => 'En proceso de intercambio', 'slug' => 'intecambio'],
            ['nombre' => 'Intercambio completado', 'slug' => 'completado'],
        ]);

        DB::table('publicacion_visibilidad')->insert([
            ['nombre' => 'Pendiente de aceptar', 'slug' => 'pendiente'],
            ['nombre' => 'Publica', 'slug' => 'activa'],
            ['nombre' => 'Se ha ocultado', 'slug' => 'oculta'],
            ['nombre' => 'Se ha baneado', 'slug' => 'ban'],
        ]);

        DB::table('motivo_denuncia')->insert([
            ['nombre' => 'Parece spam', 'slug' => 'spam'],
            ['nombre' => 'Categoría incorrecta', 'slug' => 'categoria_mala'],
            ['nombre' => 'Parece no ser real', 'slug' => 'fake'],
            ['nombre' => 'Contenido ofensivo', 'slug' => 'ofensivo'],
        ]);

        DB::table('estado_denuncia')->insert([
            ['nombre' => 'Sin revisión', 'slug' => 'pendiente'],
            ['nombre' => 'Aceptada', 'slug' => 'aceptada'],
            ['nombre' => 'Ignorada', 'slug' => 'ignorada'],
        ]);

        DB::table('habilidad')->insert([
            ['nombre' => 'Carpintería', 'slug' => 'carpinteria'],
            ['nombre' => 'Herrería', 'slug' => 'herreria'],
            ['nombre' => 'Sastrería', 'slug' => 'sastreria'],
            ['nombre' => 'Jardinería', 'slug' => 'jardineria'],
            ['nombre' => 'Electricista', 'slug' => 'electricista'],
        ]);

        DB::table('insignias')->insert([
            ['nombre' => 'Recolector novato', 'descripcion' => 'Primeros pasos en reciclaje'],
            ['nombre' => 'Ecohéroe', 'descripcion' => 'Has ayudado a muchas personas'],
            ['nombre' => 'Clasificador experto', 'descripcion' => 'Dominio en clasificación de materiales'],
        ]);

        DB::table('pais')->insert([
            ['nombre' => 'Guatemala'],
        ]);

        DB::table('departamento')->insert([
            ['nombre' => 'Quetzaltenango', 'id_pais' => 1],
        ]);

        DB::table('municipio')->insert([
            ['nombre' => 'Salcajá', 'id_departamento' => 1],
            ['nombre' => 'Almolonga', 'id_departamento' => 1],
            ['nombre' => 'Cantel', 'id_departamento' => 1],
            ['nombre' => 'Quetzaltenango', 'id_departamento' => 1],
        ]);
    }
}
