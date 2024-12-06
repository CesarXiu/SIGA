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
        return [
            'id' => $endpoint->enid,
            'type' => 'endPoint',
            'attributes' => [
                'activo' => $endpoint->activo,
                'nombre' => $endpoint->nombre,
                'descripcion' => $endpoint->descripcion,
            ],
        ];
    }
}
