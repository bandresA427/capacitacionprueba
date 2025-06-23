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
        Schema::create('capacitacion_modulos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('icono');
            $table->string('color');
            $table->text('descripcion');
            $table->integer('modulo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capacitacion_modulos');
    }
};
