<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() 
    {
        Schema::create('audit_logs', function (Blueprint $table) {
        $table->id();
$table->unsignedBigInteger('user_id')->nullable();
$table->string('type'); // 'click', 'submit', etc.
$table->string('component'); // Nombre del componente (botón, enlace, etc.)
$table->string('action'); // Acción realizada (click, submit, etc.)
$table->string('url'); // URL de la página donde se realizó la interacción
$table->timestamps();

$table->foreign('user_id')->references('id')->on('users');
        });
    }
    public function down() 
    { 
        Schema::dropIfExists('audit_logs');
    }
    
    /**
     * Reverse the migrations.
     */
};