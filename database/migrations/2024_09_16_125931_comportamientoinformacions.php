<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::create('comportamientoinformacions', function (Blueprint $table) {
            $table->id();
            $table->integer('Hidcomportamiento');
            $table->string('participante');
            $table->json('semana');
            $table->json('semana2');
            $table->json('semana3');
            $table->string('resultado');
    
    });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comportamientoinformacions');
    }
};
