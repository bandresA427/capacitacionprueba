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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('nacionalidad', ['V', 'E']);
            $table->integer('cedula')->unique();
            $table->string('name');
            $table->string('direccion');
            $table->bigInteger('telefono');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('usertype', ['admin', 'user', 'instructor'])->default('user');
            $table->enum('status', ['Activo', 'Retirado'])->default('Activo');
            $table->enum('nivel', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'])->default('1');
            

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
