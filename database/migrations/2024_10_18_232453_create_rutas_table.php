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
        Schema::create('rutas', function (Blueprint $table) {
            $table->uuid('ruid')->primary();
            $table->string('descripcion');
            $table->string('metodo');
            $table->string('ruta');
            $table->boolean('activo');
            $table->uuid('endpoint');
            $table->uuid('scope');
            $table->foreign('endpoint')->references('enid')->on('endpoints');
            $table->foreign('scope')->references('scid')->on('scope');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rutas');
    }
};
