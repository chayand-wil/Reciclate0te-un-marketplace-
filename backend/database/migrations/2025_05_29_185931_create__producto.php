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
        Schema::create('producto', function (Blueprint $table) {
            $table->id();  // Crea la columna 'id' como clave primaria
            $table->string('nombre');  // Columna 'nombre' para almacenar texto
            $table->integer('cantidad');  // Columna 'cantidad' para almacenar enteros
                // $table->timestamps(0);  // Si no deseas los campos 'created_at' y 'updated_at', puedes eliminar esta línea
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
