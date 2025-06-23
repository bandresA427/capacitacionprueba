<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     * **
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->text('usuario_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->string('respuesta');
            $table->boolean('correcta');
            $table->unsignedBigInteger('puntaje');
            $table->timestamps();

            $table->foreign('evaluacion_id')->references('id')->on('evaluacions')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas');
    }
};
