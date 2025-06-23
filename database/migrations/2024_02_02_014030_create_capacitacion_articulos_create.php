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
        Schema::create('capacitacion_articulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->mediumText('contenido');
            $table->boolean('visto')->default(FALSE);
            $table->timestamps();
            $table->unsignedBigInteger('capacitacion_modulo_id')->index();
            $table->foreign('capacitacion_modulo_id')->references('id')->on('capacitacion_modulos');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitacion_articulos');
    }
};
