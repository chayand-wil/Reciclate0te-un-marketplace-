<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {

        //         Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name', 100);
        //     $table->string('last_name', 100);
        //     $table->string('mail', 100)->unique();
        //     $table->string('password');
        //     $table->string('dpi', 20)->unique();
        //     $table->foreignId('id_estado')->constrained('estado_usuario');
        //     $table->foreignId('id_rol')->constrained('role_users');
        //     $table->foreignId('id_nivel')->constrained('nivel');
        //     $table->integer('cantidad_puntos')->default(0);
        //     $table->foreignId('id_municipio')->constrained('municipio');
        //     $table->text('detalle_direccion');
        //     $table->timestamps();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->rememberToken();
        // });

        // ADMIN
        $user = new \App\Models\User();
        $user->name = 'Yordi';
        $user->last_name = 'jon';
        $user->email = 'admin@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '123456789';
        $user->id_estado = 1;
        $user->id_rol = 1;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->id_municipio = 1;
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2000-01-01';
        $user->medio_contacto = 'http://www.instagram.com/admin';
        $user->detalle_direccion = 'Zona 1';
        $user->save();

        // REUTILIZADOR
        $user = new \App\Models\User();
        $user->name = 'Wilson';
        $user->last_name = 'Re';
        $user->email = 'reu@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '123456790';
        $user->id_estado = 1;
        $user->id_rol = 4;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/wilson';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2000-01-01';
        $user->id_municipio = 1;
        $user->detalle_direccion = 'Zona 8';
        $user->save();

        $user = new \App\Models\User();
        $user->name = 'Juan';
        $user->last_name = 'Re';
        $user->email = 'juan@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '1234567891';
        $user->id_estado = 1;
        $user->id_rol = 4;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/juan';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2000-01-01';
        $user->id_municipio = 1;
        $user->detalle_direccion = 'Zona 8';
        $user->save();

        $user = new \App\Models\User();
        $user->name = 'pepe';
        $user->last_name = 'Re';
        $user->email = 'pepe@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '1234567892';
        $user->id_estado = 1;
        $user->id_rol = 4;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/pepe';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2000-01-01';
        $user->id_municipio = 1;
        $user->detalle_direccion = 'Zona 8';
        $user->save();

        //CLASIFICADOR
        $user = new \App\Models\User();
        $user->name = 'lupe';
        $user->last_name = 'Re';
        $user->email = 'lupe@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '1234567893';
        $user->id_estado = 1;
        $user->id_rol = 3;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/lupe';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2000-01-01';
        $user->id_municipio = 4;
        $user->detalle_direccion = 'Avenida 1';
        $user->save();

        //BODEGUERO
        $user = new \App\Models\User();
        $user->name = 'Elmer';
        $user->last_name = 'Bo';
        $user->email = 'elmer@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '1234567894';
        $user->id_estado = 1;
        $user->id_rol = 2;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/elmer';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2007-01-01';
        $user->id_municipio = 3;
        $user->detalle_direccion = 'avenida 4';
        $user->save();

        $user = new \App\Models\User();
        $user->name = 'Joas';
        $user->last_name = 'Bo';
        $user->email = 'joas@wil.com';
        $user->password = bcrypt('admin123');
        $user->dpi = '1234567895';
        $user->id_estado = 1;
        $user->id_rol = 2;
        $user->id_nivel = 1;
        $user->cantidad_puntos = 0;
        $user->medio_contacto = 'http://www.facebook.com/joas';
        $user->id_genero = 1;
        $user->fecha_nacimiento = '2007-01-01';
        $user->id_municipio = 2;
        $user->detalle_direccion = 'avenida 1';
        $user->save();
    }
}
// php artisan db:seed --class=AdminSeeder
