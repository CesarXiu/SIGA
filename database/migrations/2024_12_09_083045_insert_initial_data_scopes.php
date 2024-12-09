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
        $scopes = [
            [
                'scid' => '9d4b5b4c-f514-46d3-bec0-e91228923304',
                'nombre' => 'alumno.get',
                'activo' => true,
                'endpoint' => '9da7dcef-e7d5-4147-9b23-db00a55f7846',
            ],
            [
                'scid' => '9dac0cab-5f5b-4063-b385-7425a4287b7c',
                'nombre' => 'profesor.get',
                'activo' => true,
                'endpoint' => '9da7dcfd-b6b3-4251-8c1c-99055ec8fa64'
            ],
            [
                'scid' => '9dac0cc2-978c-4ac5-9d22-bbb7d063c3c9',
                'nombre' => 'carrera.get',
                'activo' => true,
                'endpoint' => '9dac0844-1301-4fff-9cb8-ac4d757f6a04'
            ],
            [
                'scid' => '9dac0ccf-dd47-4e79-9851-2e042a1c0b78',
                'nombre' => 'kardex.get',
                'activo' => true,
                'endpoint' => '9dac0993-8af2-4a36-918e-e4b1f45f18dc'
            ],
            [
                'scid' => '9dac0cdc-6a64-42a2-9c57-44a47e8c6e14',
                'nombre' => 'periodo.get',
                'activo' => true,
                'endpoint' => '9dac08aa-91c7-4985-b841-76cdbdce6c16'
            ],
        ];

        foreach ($scopes as $scope) {
            // Verificar si el scope ya existe
            $exists = DB::table('scope')->where('scid', $scope['scid'])->exists();
            if (!$exists) {
                DB::table('scope')->insert($scope);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('scope')->whereIn('scid', [
            '9d4b5b4c-f514-46d3-bec0-e91228923304',
            '9dac0cab-5f5b-4063-b385-7425a4287b7c',
            '9dac0cc2-978c-4ac5-9d22-bbb7d063c3c9',
            '9dac0ccf-dd47-4e79-9851-2e042a1c0b78',
            '9dac0cdc-6a64-42a2-9c57-44a47e8c6e14',
        ])->delete();
    }
};
