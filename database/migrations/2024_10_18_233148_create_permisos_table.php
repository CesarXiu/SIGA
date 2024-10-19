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
        Schema::create('permisos', function (Blueprint $table) {
            $table->uuid('peid')->primary();
            $table->boolean('activo')->default(true);
            $table->string('vista');
            $table->uuid('rol');
            $table->uuid('scope');
            $table->foreign('rol')->references('roid')->on('roles');
            $table->foreign('scope')->references('scid')->on('scope');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permisos');
    }
};
