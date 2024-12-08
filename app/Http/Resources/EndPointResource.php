<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EndPointResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $endpoint = $this->resource;
        if ($endpoint->relationLoaded('getRutas')) {
            $relation = $endpoint->getRutas;
            $rutas = ["rutas" => $relation->map(function ($ruta) {
                return $ruta->resource()['data'];
            })];
        }
        $relationships = array_merge($rutas ?? [ 'a' => 'b' ]);
        return [
            'id' => $endpoint->enid,
            'type' => 'endPoint',
            'attributes' => [
                'activo' => $endpoint->activo,
                'nombre' => $endpoint->nombre,
                'descripcion' => $endpoint->descripcion,
            ],
            'relationships' => $relationships
        ];
    }
}
