<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * Clase PermisoResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso de permiso en un array.
 * 
 * @package App\Http\Resources
 */

class PermisoResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso de permiso.
     */
    public function toArray(Request $request): array
    {
        $permiso = $this->resource;

        // Verifica si la relación 'getScope' está cargada
        if ($permiso->relationLoaded('getScope')) {
            $relation = $permiso->getScope;
            $scopes = ["Scopes" => $relation->resource()['data']];
        }

        // Combina las relaciones en un array
        $relationships = array_merge($scopes ?? []);

        // Retorna el array con los datos del permiso
        return [
            'id' => $permiso->peid,
            'type' => 'permiso',
            'attributes' => [
                'activo' => $permiso->activo,
                'vista' => $permiso->vista,
                'rol' => $permiso->rol,
                'scope' => $permiso->scope,
            ],
            'relationships' => $relationships
        ];
    }
}
