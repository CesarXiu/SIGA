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
        Schema::table('scope', function (Blueprint $table) {
            $table->uuid('endpoint')->nullable(); // Agregar el campo endpoint de tipo uuid
            $table->foreign('endpoint')->references('enid')->on('endpoints')->onDelete('cascade'); // Definir la llave foránea
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scope', function (Blueprint $table) {
            $table->dropForeign(['endpoint']); // Eliminar la llave foránea
            $table->dropColumn('endpoint'); // Eliminar el campo endpoint
        });
    }
};
