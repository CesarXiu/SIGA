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
        $rutas = [
            [
                'ruid' => '9dabea4f-6012-4167-9d5b-8bddaf666733',
                'descripcion' => 'Ruta para informacion de los alumnos',
                'metodo' => 'GET',
                'ruta' => '/api/alumnos',
                'activo' => true,
                'endpoint' => '9da7dcef-e7d5-4147-9b23-db00a55f7846',
                'scope' => '9d4b5b4c-f514-46d3-bec0-e91228923304',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruid' => '9dac0c69-f8a6-4593-9f0d-a8b119aae405',
                'descripcion' => 'Obtener la informacion de un alumno',
                'metodo' => 'GET',
                'ruta' => '/api/alumnos/{alumno}',
                'activo' => true,
                'endpoint' => '9da7dcef-e7d5-4147-9b23-db00a55f7846',
                'scope' => '9d4b5b4c-f514-46d3-bec0-e91228923304',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruid' => '9dac0dd8-b7fc-4e7c-affa-557926efcdf8',
                'descripcion' => 'Obtener todos los profesores',
                'metodo' => 'GET',
                'ruta' => '/api/profesores',
                'activo' => true,
                'endpoint' => '9da7dcfd-b6b3-4251-8c1c-99055ec8fa64',
                'scope' => '9dac0cab-5f5b-4063-b385-7425a4287b7c',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruid' => '9dac0e40-7d90-41fe-9c7a-a9123d9c1b0c',
                'descripcion' => 'Obtener todas las carreras',
                'metodo' => 'GET',
                'ruta' => '/api/carreras',
                'activo' => true,
                'endpoint' => '9dac0844-1301-4fff-9cb8-ac4d757f6a04',
                'scope' => '9dac0cc2-978c-4ac5-9d22-bbb7d063c3c9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruid' => '9dac0e90-b310-4ff3-a65d-971c58e948f2',
                'descripcion' => 'Obtener el kardex de un alumno',
                'metodo' => 'GET',
                'ruta' => '/api/kardex/{kardex}',
                'activo' => true,
                'endpoint' => '9dac0993-8af2-4a36-918e-e4b1f45f18dc',
                'scope' => '9dac0ccf-dd47-4e79-9851-2e042a1c0b78',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ruid' => '9dac0ee6-f603-4185-ba5b-f8e9d6f2e0c7',
                'descripcion' => 'Obtener todos los periodos',
                'metodo' => 'GET',
                'ruta' => '/api/periodos',
                'activo' => true,
                'endpoint' => '9dac08aa-91c7-4985-b841-76cdbdce6c16',
                'scope' => '9dac0cdc-6a64-42a2-9c57-44a47e8c6e14',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($rutas as $ruta) {
            // Verificar si la ruta ya existe
            $exists = DB::table('rutas')->where('ruid', $ruta['ruid'])->exists();
            if (!$exists) {
                DB::table('rutas')->insert($ruta);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('rutas')->whereIn('ruid', [
            '9dabea4f-6012-4167-9d5b-8bddaf666733',
            '9dac0c69-f8a6-4593-9f0d-a8b119aae405',
            '9dac0dd8-b7fc-4e7c-affa-557926efcdf8',
            '9dac0e40-7d90-41fe-9c7a-a9123d9c1b0c',
            '9dac0e90-b310-4ff3-a65d-971c58e948f2',
            '9dac0ee6-f603-4185-ba5b-f8e9d6f2e0c7',
        ])->delete();
    }
};
