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
        return [
            'id' => $this->enid,
            'type' => 'endPoint',
            'attributes' => [
                'activo' => $this->activo,
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
            ],
        ];
    }
}
