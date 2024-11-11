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
        return [
            'id' => $this->coid,
            'type' => 'consumidor',
            'attributes' => [
                'nombre' => $this->nombre,
                'email' => $this->email,
                'activo' => $this->activo,
                'appid' => $this->appid,
                'rol' => $this->rol,
                'propietario' => $this->propietario,
            ],
        ];
    }
}
