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

    Schema::create('calidadinformacions', function (Blueprint $table) {
        $table->id();
        $table->integer('Hidcalidad');
        $table->string('participante');
        $table->string('identificarD');
        $table->string('identificarC');
        $table->json('correctiva');
        $table->string('resultado');

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
