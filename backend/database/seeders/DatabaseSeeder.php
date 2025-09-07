<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
 
        DB::table('motivo_notificacion')->insert([
            ['nombre' => 'Recepcion de Producto', 'slug' => 'recepcion'],
            ['nombre' => 'Listo para recoger', 'slug' => 'recogida'],
            ['nombre' => 'Registro de Solicitud ', 'slug' => 'solicitud'],
        ]);   
        DB::table('tipo_reporte')->insert([
            ['nombre' => 'Recepcion de Producto', 'slug' => 'recepcion'],
            ['nombre' => 'Listo para recoger', 'slug' => 'recogida'],
            ['nombre' => 'Registro de Solicitud ', 'slug' => 'solicitud'],
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
            ['nombre' => 'Ina   ceptable - + Amonestacion', 'slug' => 'inaceptable'],
        ]);

        DB::table('articulo_estado_adquisicion')->insert([
            ['nombre' => 'Disponible', 'slug' => 'disponible'],
            ['nombre' => 'Solicitado-disponible', 'slug' => 'solicitado-disponible'],
            ['nombre' => 'En proceso de intercambio', 'slug' => 'intercambio'],
            ['nombre' => 'Listo para recoger', 'slug' => 'recogida'],
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

        // Admin        








        










        DB::unprepared('
            CREATE TRIGGER trigger_articulo_solicitado
            AFTER INSERT ON articulo_solicitud
            FOR EACH ROW
            BEGIN
                DECLARE v_articulo_id INT;
                DECLARE total INT;

                SELECT id_articulo INTO v_articulo_id
                FROM publicacion
                WHERE id = NEW.id_publicacion;

                SELECT COUNT(*) INTO total
                FROM articulo_solicitud s
                INNER JOIN publicacion p ON s.id_publicacion = p.id
                WHERE p.id_articulo = v_articulo_id;

                IF total = 1 THEN
                    UPDATE articulo
                    SET id_articulo_estado_adquisicion = 2
                    WHERE id = v_articulo_id;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER trigger_articulo_en_intercambio
            AFTER UPDATE ON articulo_solicitud
            FOR EACH ROW
            BEGIN
                DECLARE v_articulo_id INT;

                IF NEW.id_estado_solicitud = 2 AND OLD.id_estado_solicitud <> 2 THEN
                    SELECT id_articulo INTO v_articulo_id
                    FROM publicacion
                    WHERE id = NEW.id_publicacion;

                    UPDATE articulo
                    SET id_articulo_estado_adquisicion = 3
                    WHERE id = v_articulo_id;
                END IF;
            END
        ');

        DB::unprepared('
            CREATE TRIGGER trigger_reporte_bodega_recepcion
            AFTER INSERT ON reporte_bodega
            FOR EACH ROW
            BEGIN
                DECLARE v_slug_tipo_reporte VARCHAR(50);
                DECLARE v_publicacion_id INT;
                DECLARE v_new_estado_id INT;
                DECLARE v_articulo_id INT;
                DECLARE v_usuario_current INT;
                DECLARE v_usuario_nuevo INT;
                DECLARE v_motivo_id INT;

                SELECT slug INTO v_slug_tipo_reporte
                FROM tipo_reporte
                WHERE id = NEW.id_tipo_reporte;

                IF v_slug_tipo_reporte = "recepcion" THEN
                    SET v_motivo_id = 1;
                    SET v_new_estado_id = 4;
                ELSEIF v_slug_tipo_reporte = "recogida" THEN
                    SET v_motivo_id = 2;
                    SET v_new_estado_id = 5;
                END IF;

                SELECT s.id_publicacion, s.id_usuario_nuevo
                INTO v_publicacion_id, v_usuario_nuevo
                FROM articulo_solicitud s
                WHERE s.id = NEW.id_solicitud;

                SELECT p.id_articulo, p.id_usuario
                INTO v_articulo_id, v_usuario_current
                FROM publicacion p
                WHERE p.id = v_publicacion_id;

                UPDATE articulo
                SET id_articulo_estado_adquisicion = v_new_estado_id
                WHERE id = v_articulo_id;

                INSERT INTO notificacion_usuario (id_usuario, id_publicacion, id_motivo_notificacion, created_at, updated_at)
                VALUES (v_usuario_nuevo, v_publicacion_id, v_motivo_id, NOW(), NOW());

                INSERT INTO notificacion_usuario (id_usuario, id_publicacion, id_motivo_notificacion, created_at, updated_at)
                VALUES (v_usuario_current, v_publicacion_id, v_motivo_id, NOW(), NOW());
            END
        ');

 
// Primero usuarios de ejemplo (algunos con más de 100 puntos para solicitudes)
DB::table('users')->insert([
    [
        'name' => 'Ana María',
        'last_name' => 'González López',
        'email' => 'ana.gonzalez@wil.com',
        'password' => bcrypt('admin123'),
        'dpi' => '2547896351478',
        'id_estado' => 2, // Activo
        'id_rol' => 4, // Reutilizador
        'id_nivel' => 2, // Intermedio
        'cantidad_puntos' => 150,
        'id_municipio' => 1, // Salcajá
        'id_genero' => 2, // Femenino
        'fecha_nacimiento' => '1990-05-15',
        'detalle_direccion' => 'Zona 1, 5ta calle 3-45',
        'medio_contacto' => 'WhatsApp: 45789632',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Carlos Eduardo',
        'last_name' => 'Pérez Morales',
        'email' => 'carlos.perez@wil.com',
        'password' => bcrypt('admin123'),
        'dpi' => '1234567891234',
        'id_estado' => 2, // Activo
        'id_rol' => 5, // Ecoemprendedor
        'id_nivel' => 3, // Avanzado
        'cantidad_puntos' => 320,
        'id_municipio' => 2, // Almolonga
        'id_genero' => 1, // Masculino
        'fecha_nacimiento' => '1985-03-22',
        'detalle_direccion' => 'Zona 3, Avenida Los Pinos 12-34',
        'medio_contacto' => 'Teléfono: 78451236',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'María José',
        'last_name' => 'Rodríguez Castillo',
        'email' => 'maria.rodriguez@wil.com',
        'password' => bcrypt('admin123'),
        'dpi' => '9876543219876',
        'id_estado' => 2, // Activo
        'id_rol' => 4, // Reutilizador
        'id_nivel' => 2, // Intermedio
        'cantidad_puntos' => 180,
        'id_municipio' => 3, // Cantel
        'id_genero' => 2, // Femenino
        'fecha_nacimiento' => '1992-11-08',
        'detalle_direccion' => 'Zona 2, 8va avenida 15-67',
        'medio_contacto' => 'Email y WhatsApp: 36985247',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Roberto',
        'last_name' => 'Hernández Tuy',
        'email' => 'roberto.hernandez@wil.com',
        'password' => bcrypt('admin123'),
        'dpi' => '5647382910473',
        'id_estado' => 2, // Activo
        'id_rol' => 4, // Reutilizador
        'id_nivel' => 1, // Inicial
        'cantidad_puntos' => 85,
        'id_municipio' => 4, // Quetzaltenango
        'id_genero' => 1, // Masculino
        'fecha_nacimiento' => '1988-07-30',
        'detalle_direccion' => 'Zona 5, Calzada Independencia 22-11',
        'medio_contacto' => 'Teléfono: 59637418',
        'created_at' => now(),
        'updated_at' => now(),
    ],
    [
        'name' => 'Lucía',
        'last_name' => 'Vásquez Mejía',
        'email' => 'lucia.vasquez@wil.com',
        'password' => bcrypt('admin123'),
        'dpi' => '7410852963741',
        'id_estado' => 2, // Activo
        'id_rol' => 5, // Ecoemprendedor
        'id_nivel' => 2, // Intermedio
        'cantidad_puntos' => 245,
        'id_municipio' => 1, // Salcajá
        'id_genero' => 2, // Femenino
        'fecha_nacimiento' => '1993-09-12',
        'detalle_direccion' => 'Zona 4, Calle Real 8-23',
        'medio_contacto' => 'WhatsApp: 41852963',
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Artículos de ejemplo
DB::table('articulo')->insert([
    [
        'nombre' => 'Laptop HP Pavilion usada',
        'descripcion' => 'Laptop en buen estado, ideal para estudiantes o trabajo básico',
        'detalles' => 'Procesador Intel i3, 8GB RAM, 500GB disco duro. Funciona perfectamente, solo muestra signos menores de uso. Incluye cargador original.',
        'id_categoria_articulo' => 1, // Tecnología
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Silla de oficina giratoria',
        'descripcion' => 'Silla ergonómica perfecta para home office',
        'detalles' => 'Silla con respaldo alto, brazos ajustables y base de 5 ruedas. El tapizado está en excelente estado, muy cómoda para largas jornadas de trabajo.',
        'id_categoria_articulo' => 4, // Mueblería
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Vestido floral talla M',
        'descripcion' => 'Hermoso vestido con estampado floral, perfecto para ocasiones especiales',
        'detalles' => 'Vestido de marca reconocida, talla M, colores vivos y frescos. Usado solo 2 veces, prácticamente nuevo. Ideal para primavera/verano.',
        'id_categoria_articulo' => 3, // Ropa
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Juego de platos y vasos',
        'descripcion' => 'Set completo de vajilla para 6 personas',
        'detalles' => 'Incluye 6 platos hondos, 6 platos planos, 6 vasos y 6 tazas. Material de cerámica resistente, sin roturas ni grietas. Perfecto para una familia.',
        'id_categoria_articulo' => 2, // Accesorios para hogar
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Smartphone Samsung Galaxy A30',
        'descripcion' => 'Teléfono inteligente en excelente estado',
        'detalles' => 'Samsung Galaxy A30, 64GB de almacenamiento, cámara dual, batería de larga duración. Incluye cargador, cable USB y funda protectora.',
        'id_categoria_articulo' => 1, // Tecnología
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 2, // Solicitado-disponible
    ],
    [
        'nombre' => 'Mesa de comedor de madera',
        'descripcion' => 'Mesa rectangular para 4 personas, madera sólida',
        'detalles' => 'Mesa artesanal de madera de pino, barnizada y en muy buen estado. Dimensiones: 120cm x 80cm. Muy resistente y funcional.',
        'id_categoria_articulo' => 4, // Mueblería
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 2, // Prenda artesanal
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Ropa para niño 5-6 años',
        'descripcion' => 'Lote de ropa variada para niño',
        'detalles' => 'Incluye 5 playeras, 3 pantalones, 2 shorts y 1 chamarra. Todas las prendas están en buen estado, son de diferentes marcas reconocidas.',
        'id_categoria_articulo' => 3, // Ropa
        'id_tipo_publico' => 2, // Niños
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Microondas Panasonic 20L',
        'descripcion' => 'Microondas en perfectas condiciones de funcionamiento',
        'detalles' => 'Microondas Panasonic de 20 litros, 700W de potencia. Funciona perfectamente, interior y exterior muy limpios. Incluye plato giratorio.',
        'id_categoria_articulo' => 2, // Accesorios para hogar
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 3, // En proceso de intercambio
    ]
]);

// Publicaciones de ejemplo
DB::table('publicacion')->insert([
    [
        'id_usuario' => 1, // Ana María
        'id_articulo' => 1, // Laptop HP
        'imagen_url' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop,https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 45,
        'created_at' => now()->subDays(5),
        'updated_at' => now()->subDays(5),
    ],
    [
        'id_usuario' => 2, // Carlos Eduardo
        'id_articulo' => 2, // Silla de oficina
        'imagen_url' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 23,
        'created_at' => now()->subDays(3),
        'updated_at' => now()->subDays(3),
    ],
    [
        'id_usuario' => 3, // María José
        'id_articulo' => 3, // Vestido floral
        'imagen_url' => 'https://images.unsplash.com/photo-1515372039744-b8f02a3ae446?w=400&h=300&fit=crop,https://images.unsplash.com/photo-1594633312681-425c7b97ccd1?w=400&h=300&fit=crop,https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 67,
        'created_at' => now()->subDays(7),
        'updated_at' => now()->subDays(7),
    ],
    [
        'id_usuario' => 1, // Ana María
        'id_articulo' => 4, // Juego de platos
        'imagen_url' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 12,
        'created_at' => now()->subDays(2),
        'updated_at' => now()->subDays(2),
    ],
    [
        'id_usuario' => 5, // Lucía
        'id_articulo' => 5, // Samsung Galaxy
        'imagen_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400&h=300&fit=crop,https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 89,
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(4),
    ],
    [
        'id_usuario' => 2, // Carlos Eduardo
        'id_articulo' => 6, // Mesa de comedor
        'imagen_url' => 'https://images.unsplash.com/photo-1549497538-303791108f95?w=400&h=300&fit=crop,https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 34,
        'created_at' => now()->subDays(6),
        'updated_at' => now()->subDays(6),
    ],
    [
        'id_usuario' => 3, // María José
        'id_articulo' => 7, // Ropa para niño
        'imagen_url' => 'https://images.unsplash.com/photo-1519238263530-99bdd11df2ea?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 28,
        'created_at' => now()->subDays(1),
        'updated_at' => now()->subDays(1),
    ],
    [
        'id_usuario' => 5, // Lucía
        'id_articulo' => 8, // Microondas
        'imagen_url' => 'https://images.unsplash.com/photo-1574269909862-7e1d70bb8078?w=400&h=300&fit=crop',
        'id_publicacion_visibilidad' => 1, // Pendiente de aceptar
        'cantidad_visualizaciones' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);

// Solicitudes de artículos (solo usuarios con más de 100 puntos)
DB::table('articulo_solicitud')->insert([
    [
        'id_estado_solicitud' => 1, // Pendiente
        'id_publicacion' => 1, // Laptop HP (publicada por Ana María)
        'id_usuario_nuevo' => 2, // Carlos Eduardo solicita (320 puntos)
        'created_at' => now()->subDays(2),
        'updated_at' => now()->subDays(2),
    ],
    [
        'id_estado_solicitud' => 2, // Aceptada
        'id_publicacion' => 5, // Samsung Galaxy (publicada por Lucía)
        'id_usuario_nuevo' => 1, // Ana María solicita (150 puntos)
        'created_at' => now()->subDays(3),
        'updated_at' => now()->subDays(1),
    ],
    [
        'id_estado_solicitud' => 1, // Pendiente
        'id_publicacion' => 3, // Vestido floral (publicada por María José)
        'id_usuario_nuevo' => 5, // Lucía solicita (245 puntos)
        'created_at' => now()->subDays(1),
        'updated_at' => now()->subDays(1),
    ],
    [
        'id_estado_solicitud' => 2, // Aceptada
        'id_publicacion' => 6, // Mesa de comedor (publicada por Carlos)
        'id_usuario_nuevo' => 3, // María José solicita (180 puntos)
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(2),
    ],
    [
        'id_estado_solicitud' => 3, // Rechazada
        'id_publicacion' => 2, // Silla de oficina (publicada por Carlos)
        'id_usuario_nuevo' => 1, // Ana María solicita (150 puntos)
        'created_at' => now()->subDays(5),
        'updated_at' => now()->subDays(3),
    ],
    [
        'id_estado_solicitud' => 1, // Pendiente
        'id_publicacion' => 4, // Juego de platos (publicada por Ana María)
        'id_usuario_nuevo' => 2, // Carlos Eduardo solicita (320 puntos)
        'created_at' => now()->subHours(6),
        'updated_at' => now()->subHours(6),
    ]
]);

// Algunos comentarios en las publicaciones
DB::table('publicacion_comentario')->insert([
    [
        'texto_comentario' => '¡Excelente laptop! ¿Aún funciona la cámara web?',
        'id_publicacion' => 1,
        'id_usuario' => 2, // Carlos Eduardo
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(4),
    ],
    [
        'texto_comentario' => 'Sí, la cámara funciona perfectamente. También tiene micrófono integrado.',
        'id_publicacion' => 1,
        'id_usuario' => 1, // Ana María (dueña)
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(4),
    ],
    [
        'texto_comentario' => 'Me interesa mucho el vestido. ¿Podríamos coordinar para verlo?',
        'id_publicacion' => 3,
        'id_usuario' => 5, // Lucía
        'created_at' => now()->subDays(6),
        'updated_at' => now()->subDays(6),
    ],
    [
        'texto_comentario' => 'Perfecto para mi cocina. ¿Incluye manual de usuario?',
        'id_publicacion' => 8,
        'id_usuario' => 3, // María José
        'created_at' => now()->subHours(2),
        'updated_at' => now()->subHours(2),
    ]
]);

// Algunos likes en las publicaciones
DB::table('publicacion_like')->insert([
    [
        'id_publicacion' => 1, // Laptop
        'id_usuario' => 2, // Carlos Eduardo
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(4),
    ],
    [
        'id_publicacion' => 1, // Laptop
        'id_usuario' => 3, // María José
        'created_at' => now()->subDays(3),
        'updated_at' => now()->subDays(3),
    ],
    [
        'id_publicacion' => 3, // Vestido
        'id_usuario' => 1, // Ana María
        'created_at' => now()->subDays(6),
        'updated_at' => now()->subDays(6),
    ],
    [
        'id_publicacion' => 3, // Vestido
        'id_usuario' => 5, // Lucía
        'created_at' => now()->subDays(6),
        'updated_at' => now()->subDays(6),
    ],
    [
        'id_publicacion' => 5, // Samsung
        'id_usuario' => 2, // Carlos Eduardo
        'created_at' => now()->subDays(3),
        'updated_at' => now()->subDays(3),
    ]
]);

//funcioannnnnnnnnn
// Artículos duplicados con nuevos datos
DB::table('articulo')->insert([
    [
        'nombre' => 'Notebook Dell Inspiron reacondicionada',
        'descripcion' => 'Computadora portátil refurbished, excelente para oficina y estudios',
        'detalles' => 'Procesador AMD Ryzen 5, 16GB RAM, SSD 256GB. Recién formateada con Windows 11. Batería nueva, incluye mouse inalámbrico y bolso para transporte.',
        'id_categoria_articulo' => 1, // Tecnología
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Sillón ejecutivo con apoyabrazos',
        'descripcion' => 'Silla de escritorio con soporte lumbar, muy cómoda',
        'detalles' => 'Sillón de cuero sintético negro, altura regulable, mecanismo de inclinación. Las ruedas funcionan perfectamente, ideal para trabajo desde casa.',
        'id_categoria_articulo' => 4, // Mueblería
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Blusa estampada talla L',
        'descripcion' => 'Elegante blusa con diseño geométrico, perfecta para el trabajo',
        'detalles' => 'Blusa de poliéster con estampado moderno, talla L, corte clásico. Sin manchas ni decoloraciones, se ve prácticamente nueva. Combina con cualquier pantalón.',
        'id_categoria_articulo' => 3, // Ropa
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Set de ollas y sartenes',
        'descripcion' => 'Batería de cocina completa antiadherente',
        'detalles' => 'Incluye 3 ollas de diferentes tamaños, 2 sartenes y 1 cacerola. Recubrimiento antiadherente en excelente estado, mangos ergonómicos. Aptas para todo tipo de cocinas.',
        'id_categoria_articulo' => 2, // Accesorios para hogar
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 3, // Media
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'iPhone 12 desbloqueado',
        'descripcion' => 'Smartphone Apple en perfectas condiciones',
        'detalles' => 'iPhone 12 de 128GB, color azul, desbloqueado para cualquier operadora. Pantalla sin rayones, batería al 89%. Incluye cargador lightning y protector de pantalla.',
        'id_categoria_articulo' => 1, // Tecnología
        'id_tipo_publico' => 1, // Adultos
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 2, // Solicitado-disponible
    ],
    [
        'nombre' => 'Escritorio de madera maciza',
        'descripcion' => 'Escritorio rústico con cajones, ideal para estudio',
        'detalles' => 'Escritorio hecho a mano en madera de roble, 4 cajones con correderas metálicas. Superficie amplia de 140cm x 70cm. Acabado en barniz mate, muy duradero.',
        'id_categoria_articulo' => 4, // Mueblería
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 2, // Prenda artesanal
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Paquete de ropa niña 4-5 años',
        'descripcion' => 'Conjunto variado de vestidos y blusas para niña',
        'detalles' => 'Contiene 4 vestidos, 6 blusas, 2 faldas y 1 chaqueta de mezclilla. Colores vibrantes y diseños infantiles. Todas las prendas de marcas conocidas como Zara Kids.',
        'id_categoria_articulo' => 3, // Ropa
        'id_tipo_publico' => 2, // Niños
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 3, // Usado bueno
        'id_articulo_estado_adquisicion' => 1, // Disponible
    ],
    [
        'nombre' => 'Cafetera Express Oster',
        'descripcion' => 'Máquina de café automática programable',
        'detalles' => 'Cafetera Oster de 12 tazas, función de programación 24h, placa calefactora. Jarra de vidrio incluida, filtro permanente. Funciona como nueva, muy bien cuidada.',
        'id_categoria_articulo' => 2, // Accesorios para hogar
        'id_tipo_publico' => 3, // Para toda la familia
        'calidad_articulo' => 4, // Marca reconocida
        'estado_articulo' => 4, // Usado como nuevo
        'id_articulo_estado_adquisicion' => 3, // En proceso de intercambio
    ]
]);

// Publicaciones duplicadas con nuevos datos
DB::table('publicacion')->insert([
    [
        'id_usuario' => 1, // Ana María
        'id_articulo' => 9, // Notebook Dell
        'imagen_url' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=300&h=200&fit=crop,https://images.unsplash.com/photo-1484788984921-03950022c9ef?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 45,
        'created_at' => now()->subDays(5),
        'updated_at' => now()->subDays(5),
    ],
    [
        'id_usuario' => 2, // Carlos Eduardo
        'id_articulo' => 10, // Sillón ejecutivo
        'imagen_url' => 'https://images.unsplash.com/photo-1541558869434-2840d308329a?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 23,
        'created_at' => now()->subDays(3),
        'updated_at' => now()->subDays(3),
    ],
    [
        'id_usuario' => 3, // María José
        'id_articulo' => 11, // Blusa estampada
        'imagen_url' => 'https://images.unsplash.com/photo-1544022613-e87ca75a784a?w=300&h=200&fit=crop,https://images.unsplash.com/photo-1562137369-1a1a0bc66744?w=300&h=200&fit=crop,https://images.unsplash.com/photo-1581044777550-4cfa60707c03?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 67,
        'created_at' => now()->subDays(7),
        'updated_at' => now()->subDays(7),
    ],
    [
        'id_usuario' => 1, // Ana María
        'id_articulo' => 12, // Set de ollas
        'imagen_url' => 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 12,
        'created_at' => now()->subDays(2),
        'updated_at' => now()->subDays(2),
    ],
    [
        'id_usuario' => 5, // Lucía
        'id_articulo' => 13, // iPhone 12
        'imagen_url' => 'https://images.unsplash.com/photo-1592286968390-98b9be7fb0e2?w=300&h=200&fit=crop,https://images.unsplash.com/photo-1580910051074-3eb694886505?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 89,
        'created_at' => now()->subDays(4),
        'updated_at' => now()->subDays(4),
    ],
    [
        'id_usuario' => 2, // Carlos Eduardo
        'id_articulo' => 14, // Escritorio de madera
        'imagen_url' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=300&h=200&fit=crop,https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 34,
        'created_at' => now()->subDays(6),
        'updated_at' => now()->subDays(6),
    ],
    [
        'id_usuario' => 3, // María José
        'id_articulo' => 15, // Ropa para niña
        'imagen_url' => 'https://images.unsplash.com/photo-1503944168730-28659bf368ee?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 2, // Pública
        'cantidad_visualizaciones' => 28,
        'created_at' => now()->subDays(1),
        'updated_at' => now()->subDays(1),
    ],
    [
        'id_usuario' => 5, // Lucía
        'id_articulo' => 16, // Cafetera
        'imagen_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=300&h=200&fit=crop',
        'id_publicacion_visibilidad' => 1, // Pendiente de aceptar
        'cantidad_visualizaciones' => 0,
        'created_at' => now(),
        'updated_at' => now(),
    ]
]);


// otras


 












    }
}
