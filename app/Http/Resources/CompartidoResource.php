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
        $compartido = $this->resource;
        if ($compartido->relationLoaded('getConsumidor')) {
            $consumidor = ["Consumidor" => $compartido->getConsumidor->resource()['data']];
        }
        $relationships = array_merge($consumidor ?? []);
        return [
            'id' => $compartido->coid,
            'type' => 'compartido',
            'attributes' => [
                'activo' => $compartido->activo,
                'usuario' => $compartido->usuario,
                'consumidor' => $compartido->consumidor,
            ],
            'relationships' => $relationships
        ];
    }
}
