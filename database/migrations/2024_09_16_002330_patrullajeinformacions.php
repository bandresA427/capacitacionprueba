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
        Schema::create('patrullajeinformacions', function (Blueprint $table) {
            $table->id();
            $table->string('participante');
            $table->string('disciplina');
            $table->json('tiemposrecorrido');
            $table->float('resultado');
            $table->string('cumplimiento');
            $table->integer('Hidpatrullaje');

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicasinformacions');
    }
};
