<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScopeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $scope = $this->resource;
        if ($scope->relationLoaded('getEndPoint')) {
            $end = $scope->getEndPoint;
            $endpoint = ["EndPoint" => $end->resource()['data']];
        }
        $relationships = array_merge($endpoint ?? []);
        return [
            'id' => $scope->scid,
            'type' => 'scope',
            'attributes' => [
                'activo' => $scope->activo,
                'nombre' => $scope->nombre,
                'endpoint' => $scope->endpoint,
            ],
            'relationships' => $relationships
        ];
    }
}
