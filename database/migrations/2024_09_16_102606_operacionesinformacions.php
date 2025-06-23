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
        Schema::create('operacionesinformacions', function (Blueprint $table) {
            $table->id();
            $table->string('participante');
            $table->string('calificacionNS');
            $table->json('tiempostrama');
            $table->float('resultadotrama');
            $table->json('tiemposurdimbre');
            $table->float('resultadourdimbre');
            $table->string('usoherramientas');
            $table->string('limpiezaOT');
            $table->string('sopladoT');
            $table->integer('Hidoperaciones');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacionesinformacions');
    }
};
