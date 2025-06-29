<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->json('preguntas');
            $table->integer('nivel');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evaluacions');
    }
};