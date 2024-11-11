<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModeloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->moid,
            'type' => 'modelo',
            'attributes' => [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'data' => $this->data,
                'solicitud' => $this->solicitud,
            ],
        ];
    }
}
