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
        $endpoints = [
            [
                'enid' => '9da7dcef-e7d5-4147-9b23-db00a55f7846',
                'nombre' => 'Alumnos',
                'descripcion' => 'Informacion de los alumnos',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enid' => '9da7dcfd-b6b3-4251-8c1c-99055ec8fa64',
                'nombre' => 'Profesores',
                'descripcion' => 'Informacion de los profesores',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enid' => '9dac0844-1301-4fff-9cb8-ac4d757f6a04',
                'nombre' => 'Carreras',
                'descripcion' => 'Informacion de las carreras',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enid' => '9dac08aa-91c7-4985-b841-76cdbdce6c16',
                'nombre' => 'Periodos',
                'descripcion' => 'Informacion de los periodos',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'enid' => '9dac0993-8af2-4a36-918e-e4b1f45f18dc',
                'nombre' => 'Kardex',
                'descripcion' => 'Informacion del Kardex del alumno',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($endpoints as $endpoint) {
            // Verificar si el endpoint ya existe
            $exists = DB::table('endpoints')->where('enid', $endpoint['enid'])->exists();
            if (!$exists) {
                DB::table('endpoints')->insert($endpoint);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('endpoints')->whereIn('enid', [
            '9da7dcef-e7d5-4147-9b23-db00a55f7846',
            '9da7dcfd-b6b3-4251-8c1c-99055ec8fa64',
            '9dac0844-1301-4fff-9cb8-ac4d757f6a04',
            '9dac08aa-91c7-4985-b841-76cdbdce6c16',
            '9dac0993-8af2-4a36-918e-e4b1f45f18dc',
        ])->delete();
    }
};
