<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase RutaResource
 * 
 * Esta clase extiende de JsonResource y se utiliza para transformar los datos de una ruta en un formato JSON específico.
 */
class RutaResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array asociativo que representa los datos de la ruta.
     */
    public function toArray(Request $request): array
    {
        $ruta =  $this->resource;
        // Verifica si la relación 'getScope' está cargada
        if ($ruta->relationLoaded('getScope')) {
            $relation = $ruta->getScope;
            $scopes = ["Scope" => $relation->resource()['data']];
        }
        // Verifica si la relación 'getEndpoint' está cargada
        if ($ruta->relationLoaded('getEndpoint')) {
            $relation = $ruta->getEndpoint;
            $endpoint = ["EndPoint" => $relation->resource()['data']];
        }

        // Combina las relaciones en un array
        $relationships = array_merge($scopes ?? [] , $endpoint ?? []);
        return [
            'id' => $ruta->ruid, // El identificador único de la ruta.
            'type' => 'ruta', // El tipo de recurso, en este caso 'ruta'.
            'attributes' => [
                'metodo' => $ruta->metodo, // El método HTTP asociado a la ruta (GET, POST, etc.).
                'descripcion' => $ruta->descripcion, // Una descripción de la ruta.
                'ruta' => $ruta->ruta, // La URL o ruta específica.
                'activo' => $ruta->activo, // Indica si la ruta está activa o no.
                'endpoint' => $ruta->endpoint, // El endpoint asociado a la ruta.
                'scope' => $ruta->scope, // El alcance o ámbito de la ruta.
            ],
            'relationships' => $relationships // Las relaciones asociadas a la ruta.
        ];
    }
}
