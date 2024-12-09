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
        $permisos = [
            [
                'peid' => '9dadc62c-e212-49bc-8333-46a33e36544b',
                'activo' => true,
                'vista' => 'basic',
                'rol' => '9d4b5f15-c250-4ac0-9a41-f8c9c2155d05',
                'scope' => '9d4b5b4c-f514-46d3-bec0-e91228923304'
            ],
            [
                'peid' => '9dae910a-bcc3-4abf-8f71-9b0754308962',
                'activo' => true,
                'vista' => 'basic',
                'rol' => '9d4b5f15-c250-4ac0-9a41-f8c9c2155d05',
                'scope' => '9dac0cab-5f5b-4063-b385-7425a4287b7c'
            ],
            [
                'peid' => '9dae97a7-5ddf-4cb6-8b0a-242c2766152a',
                'activo' => true,
                'vista' => 'basic',
                'rol' => '9d4b5f15-c250-4ac0-9a41-f8c9c2155d05',
                'scope' => '9dac0cdc-6a64-42a2-9c57-44a47e8c6e14'
            ],
        ];

        foreach ($permisos as $permiso) {
            // Verificar si el permiso ya existe
            $exists = DB::table('permisos')->where('peid', $permiso['peid'])->exists();
            if (!$exists) {
                DB::table('permisos')->insert($permiso);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('permisos')->whereIn('peid', [
            '9dadc62c-e212-49bc-8333-46a33e36544b',
            '9dae910a-bcc3-4abf-8f71-9b0754308962',
            '9dae97a7-5ddf-4cb6-8b0a-242c2766152a',
        ])->delete();
    }
};
