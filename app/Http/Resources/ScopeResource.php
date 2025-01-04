<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase ScopeResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso de "Scope" en un array.
 * 
 * @package App\Http\Resources
 */

class ScopeResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso transformado.
     */
    public function toArray(Request $request): array
    {
        $scope = $this->resource;
        
        // Verifica si la relación 'getEndPoint' está cargada
        if ($scope->relationLoaded('getEndPoint')) {
            $end = $scope->getEndPoint;
            // Obtiene los datos del endpoint y los almacena en un array
            $endpoint = ["EndPoint" => $end->resource()['data']];
        }
        
        // Combina las relaciones en un solo array
        $relationships = array_merge($endpoint ?? []);
        
        // Retorna el array transformado con los atributos y relaciones del recurso
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
