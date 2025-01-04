<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase EndPointResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso de endpoint en un array.
 * Proporciona una representación en formato JSON del recurso, incluyendo sus relaciones con rutas y scopes.
 */
class EndPointResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso transformado.
     */
    public function toArray(Request $request): array
    {
        $endpoint = $this->resource;

        // Verifica si la relación 'getRutas' está cargada y la transforma en un array.
        if ($endpoint->relationLoaded('getRutas')) {
            $relation = $endpoint->getRutas;
            $rutas = ["rutas" => $relation->map(function ($ruta) {
                return $ruta->resource()['data'];
            })];
        }

        // Verifica si la relación 'getScopes' está cargada y la transforma en un array.
        if ($endpoint->relationLoaded('getScopes')) {
            $relation = $endpoint->getScopes;
            $scopes = ["scopes" => $relation->map(function ($scope) {
                return $scope->resource()['data'];
            })];
        }

        // Combina las relaciones de rutas y scopes en un solo array.
        $relationships = array_merge($rutas ?? [], $scopes ?? []);

        // Retorna el array que representa el recurso transformado.
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
