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
        Schema::create('compartidos', function (Blueprint $table) {
            $table->uuid('coid')->primary();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('usuario');
            $table->uuid('consumidor');
            $table->foreign('usuario')->references('id')->on('users');
            $table->foreign('consumidor')->references('coid')->on('consumidores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartidos');
    }
};
