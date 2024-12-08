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
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->uuid('consumidor')->nullable(); // Agregar el campo endpoint de tipo uuid
            $table->foreign('consumidor')->references('coid')->on('consumidores')->onDelete('cascade'); // Definir la llave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes', function (Blueprint $table) {
            $table->dropForeign(['consumidor']); // Eliminar la llave foránea
            $table->dropColumn('consumidor'); // Eliminar el campo endpoint
        });
    }
};
