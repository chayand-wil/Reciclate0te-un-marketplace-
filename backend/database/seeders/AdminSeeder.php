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

 $user = new \App\Models\User();
$user->name = 'admin';
$user->last_name = 'jon';
$user->email = 'admin@wil.com';
$user->password = bcrypt('admin123');
$user->dpi = '1234567890103';
$user->id_estado = 1;
$user->id_rol = 1;
$user->id_nivel = 1;
$user->cantidad_puntos = 0;
$user->id_municipio = 1;
$user->id_genero = 1;
$user->fecha_nacimiento = '2000-01-01';
$user->medio_contacto = 'insta';
$user->detalle_direccion = 'Zona 1';
$user->save();

$user = new \App\Models\User();
$user->name = 'reutilizador';
$user->last_name = 'reu';
$user->email = 'reu@wil.com';
$user->password = bcrypt('admin123');
$user->dpi = '1234567893';
$user->id_estado = 1;
$user->id_rol = 4;
$user->id_nivel = 1;
$user->cantidad_puntos = 0;
$user->medio_contacto = 'insta';
$user->id_genero = 1;
$user->fecha_nacimiento = '2000-01-01';
$user->id_municipio = 1;
$user->detalle_direccion = 'Zona 8';
$user->save();





//         $user = new \App\Models\User();
// $user->name = 'Admin';
// $user->last_name = 'Principal';
// $user->email = 'admin@ejemplo.com';
// $user->password = bcrypt('password');
// $user->dpi = '1234567890101';
// $user->id_estado = 1;
// $user->id_rol = 1;
// $user->id_nivel = 1;
// $user->cantidad_puntos = 0;
// $user->id_municipio = 1;
// $user->detalle_direccion = 'Zona 1';
// $user->save();



    }

}
// php artisan db:seed --class=AdminSeeder
