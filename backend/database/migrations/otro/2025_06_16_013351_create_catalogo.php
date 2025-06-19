<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {


 Schema::create('usuario_moderador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
        });

        Schema::create('solicitud_moderador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_estado_solicitud')->constrained('estado_solicitud');
        });

        Schema::create('usuario_insignia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_insignia')->constrained('insignias');
            $table->foreignId('id_usuario')->constrained('users');
        });

        Schema::create('bodega', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('id_municipio')->constrained('municipio');
            $table->text('detalle_direccion');
        });

        Schema::create('clasificadora', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->foreignId('id_municipio')->constrained('municipio');
            $table->text('detalle_direccion');
        });

        Schema::create('user_bodega', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_bodega')->constrained('bodega');
        });

        Schema::create('user_clasificadora', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_clasificadora')->constrained('clasificadora');
        });

        Schema::create('habilidad_ecoemprendedor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_habilidad')->constrained('habilidad');
        });

        Schema::create('solicitud_ecoemprendedor_activacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_estado_solicitud')->constrained('estado_solicitud');
        });

        Schema::create('ecoemprendedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_estado')->constrained('estado_usuario');
        });

        Schema::create('articulo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->text('descripcion');
            $table->text('detalles');
            $table->foreignId('id_categoria_articulo')->constrained('categoria_articulo');
            $table->foreignId('id_tipo_publico')->constrained('tipo_publico');
            $table->foreignId('calidad_articulo')->constrained('calidad_articulo');
            $table->foreignId('estado_articulo')->constrained('estado_articulo');
            $table->foreignId('id_articulo_estado_adquisicion')->constrained('articulo_estado_adquisicion');
        });

        Schema::create('publicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_articulo')->constrained('articulo');
            $table->text('imagen_url');
            $table->foreignId('id_publicacion_visibilidad')->constrained('publicacion_visibilidad');
            $table->integer('cantidad_visualizaciones')->default(0);
            $table->timestamps();
        });

        Schema::create('publicacion_like', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_usuario')->constrained('users');
            $table->timestamps();
        });

        Schema::create('publicacion_comentario', function (Blueprint $table) {
            $table->id();
            $table->text('texto_comentario');
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_usuario')->constrained('users');
            $table->timestamps();
        });

        Schema::create('articulo_solicitud', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estado_solicitud')->constrained('estado_solicitud');
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_usuario_nuevo')->constrained('users');
            $table->timestamps();
        });

        Schema::create('notificacion_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->string('motivo', 255);
            $table->text('detalle_notificacion');
            $table->timestamps();
        });

        Schema::create('denuncia_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->constrained('users');
            $table->foreignId('id_motivo_denuncia')->constrained('motivo_denuncia');
            $table->foreignId('id_estado_denuncia')->constrained('estado_denuncia');
            $table->timestamps();
        });

        Schema::create('denuncia_publicacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_publicacion')->constrained('publicacion');
            $table->foreignId('id_motivo_denuncia')->constrained('motivo_denuncia');
            $table->foreignId('id_estado_denuncia')->constrained('estado_denuncia');
            $table->timestamps();
        });
    }








 

     
    

    public function down(): void
    {
        Schema::dropIfExists('denuncia_publicacion');
        Schema::dropIfExists('denuncia_usuario');
        Schema::dropIfExists('notificacion_usuario');
        Schema::dropIfExists('articulo_solicitud');
        Schema::dropIfExists('publicacion_comentario');
        Schema::dropIfExists('publicacion_like');
        Schema::dropIfExists('publicacion');
        Schema::dropIfExists('articulo');
        Schema::dropIfExists('ecoemprendedores');
        Schema::dropIfExists('solicitud_ecoemprendedor_activacion');
        Schema::dropIfExists('habilidad_ecoemprendedor');
        Schema::dropIfExists('user_clasificadora');
        Schema::dropIfExists('user_bodega');
        Schema::dropIfExists('clasificadora');
        Schema::dropIfExists('bodega');
        Schema::dropIfExists('usuario_insignia');
        Schema::dropIfExists('solicitud_moderador');
        Schema::dropIfExists('usuario_moderador');
        Schema::dropIfExists('users');
        Schema::dropIfExists('nivel');
        Schema::dropIfExists('insignias');
        Schema::dropIfExists('estado_usuario');
        Schema::dropIfExists('habilidad');
        Schema::dropIfExists('role_users');
        Schema::dropIfExists('publicacion_visibilidad');
        Schema::dropIfExists('estado_solicitud');
        Schema::dropIfExists('articulo_estado_adquisicion');
        Schema::dropIfExists('estado_articulo');
        Schema::dropIfExists('calidad_articulo');
        Schema::dropIfExists('tipo_publico');
        Schema::dropIfExists('categoria_articulo');
        Schema::dropIfExists('estado_denuncia');
        Schema::dropIfExists('motivo_denuncia');
        Schema::dropIfExists('municipio');
        Schema::dropIfExists('departamento');
        Schema::dropIfExists('pais');
    }
};
