<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
// CREATE DATABASE reciclate_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

                // Tablas Catálogo
        Schema::create('pais', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
        });

        Schema::create('departamento', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('id_pais')->constrained('pais')->onDelete('cascade');
        });

        Schema::create('municipio', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->foreignId('id_departamento')->constrained('departamento')->onDelete('cascade');
        });

        Schema::create('motivo_denuncia', function (Blueprint $table) {
            $table->id();
            $table->string('motivo', 255);
        });

        Schema::create('estado_denuncia', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 100);
        });

        Schema::create('categoria_articulo', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 100);
        });

        Schema::create('tipo_publico', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 100);
        });

        Schema::create('calidad_articulo', function (Blueprint $table) {
            $table->id();
            $table->string('calidad', 50);
            $table->string('slug', 50);
        });

        Schema::create('estado_articulo', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 50);
            $table->string('slug', 50);
        });

        Schema::create('articulo_estado_adquisicion', function (Blueprint $table) {
            $table->id();
            $table->string('estado_adquisicion', 100);
            $table->string('slug', 50);
        });

        Schema::create('estado_solicitud', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 100);
            $table->string('slug', 50);
        });

        Schema::create('publicacion_visibilidad', function (Blueprint $table) {
            $table->id();
            $table->string('visibilidad', 100);
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('slug', 50);
        });

        Schema::create('habilidad', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 100);
            $table->string('slug', 50);
        });

        Schema::create('estado_usuario', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 100);
        });

        Schema::create('insignias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion');
        });

        Schema::create('nivel', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_nivel', 100);
            $table->text('descripcion');
            $table->integer('puntos_necesarios');
        });



        // Schema::create('users', function (Blueprint $table) {
            
            
        //     // // Clave foránea hacia tabla roles
        //     // $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
            
        // });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('dpi', 20)->unique()->nullable();
            $table->foreignId('id_estado')->constrained('estado_usuario')->nullable();
            $table->foreignId('id_rol')->constrained('role_users');
            $table->foreignId('id_nivel')->constrained('nivel')->nullable();
            $table->integer('cantidad_puntos')->default(0);
            $table->foreignId('id_municipio')->constrained('municipio')->nullable();
            $table->text('detalle_direccion')->nullable();
            $table->text('contacto')->nullable();
            $table->timestamps();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
        });





        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }








    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
