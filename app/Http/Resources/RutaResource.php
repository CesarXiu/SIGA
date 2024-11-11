<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RutaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ruid,
            'type' => 'ruta',
            'attributes' => [
                'metodo' => $this->metodo, 
                'descripcion' => $this->descripcion,
                'ruta' => $this->ruta,
                'activo' => $this->activo,
                'endpoint' => $this->endpoint,
                'scope' => $this->scope,
            ],
        ];
    }
}
