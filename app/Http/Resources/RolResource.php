<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RolResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $rol = $this->resource;
        return [
            'id' => $rol->roid,
            'type' => 'rol',
            'attributes' => [
                'activo' => $rol->activo,
                'nombre' => $rol->nombre,
                'descripcion' => $rol->descripcion,
            ],
        ];
    }
}
