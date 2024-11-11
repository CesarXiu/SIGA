<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompartidoResource extends JsonResource
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
            'type' => 'compartido',
            'attributes' => [
                'activo' => $this->activo,
                'usuario' => $this->usuario,
                'consumidor' => $this->consumidor,
            ],
        ];
    }
}
