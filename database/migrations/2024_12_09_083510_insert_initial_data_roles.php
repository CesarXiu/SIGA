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
        $roles = [
            [
                'roid' => '9d4b5f15-c250-4ac0-9a41-f8c9c2155d05',
                'nombre' => 'residencias',
                'descripcion' => 'Acceso a informacion vital para el proceso de residencias',
                'activo' => true
            ],
        ];

        foreach ($roles as $role) {
            // Verificar si el rol ya existe
            $exists = DB::table('roles')->where('roid', $role['roid'])->exists();
            if (!$exists) {
                DB::table('roles')->insert($role);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('roles')->where('roid', '9d4b5f15-c250-4ac0-9a41-f8c9c2155d05')->delete();
    }
};
