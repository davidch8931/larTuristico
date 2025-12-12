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
        Schema::create('lugar_turistico', function (Blueprint $table) {
            $table->id('id_lugar');
            $table->string('nombre');
            $table->string('coordenadas');
            $table->string('descripcion');
            $table->integer('anio');
            $table->string('accesibilidad');
            $table->foreignId('fk_id_provincia')->constrained('provincia', 'id_provincia');
            $table->foreignId('fk_id_tipo')->constrained('tipo_atraccion', 'id_atraccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lugar_turistico');
    }
};
