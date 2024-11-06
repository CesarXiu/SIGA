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
        Schema::create('modelos', function (Blueprint $table) {
            $table->uuid('moid')->primary();
            $table->string('nombre');
            $table->string('descripcion');
            $table->binary('data');
            $table->uuid('solicitud');
            $table->foreign('solicitud')->references('soid')->on('solicitudes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
