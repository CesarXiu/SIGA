<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsumidorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $consumidor = $this->resource;
        if ($consumidor->relationLoaded('getApp')) {
            $App = $consumidor->getApp->resource()['data'];
        }
        $relationships = array_merge(["App" => $App] ?? []);
        return [ 
            'id' => $consumidor->coid,
            'type' => 'consumidor',
            'attributes' => [
                'nombre' => $consumidor->nombre,
                'email' => $consumidor->email,
                'activo' => $consumidor->activo,
                'appid' => $consumidor->appid,
                'rol' => $consumidor->rol,
                'propietario' => $consumidor->propietario,
            ],
            'relationships' => $relationships
        ];
    }
}
