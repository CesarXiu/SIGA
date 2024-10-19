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
        Schema::create('consumidores', function (Blueprint $table) {
            $table->uuid('coid')->primary();
            $table->string('nombre');
            $table->string('password');
            $table->string('email')->unique();
            $table->boolean('activo')->default(true);
            $table->uuid('appid');
            $table->uuid('rol');
            $table->unsignedBigInteger('propietario');
            $table->foreign('appid')->references('id')->on('oauth_clients');
            $table->foreign('rol')->references('roid')->on('roles');
            $table->foreign('propietario')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consumidores');
    }
};
