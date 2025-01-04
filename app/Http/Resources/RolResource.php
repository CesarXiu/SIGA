<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase RolResource
 * 
 * Esta clase extiende de JsonResource y se utiliza para transformar un recurso de Rol en un array.
 * 
 * @package App\Http\Resources
 */
class RolResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso transformado.
     */
    public function toArray(Request $request): array
    {
        $rol = $this->resource;

        // Verifica si la relación 'getPermisos' está cargada
        if ($rol->relationLoaded('getPermisos')) {
            $relation = $rol->getPermisos;
            // Mapea los permisos y los transforma en un array
            $permisos = ["permisos" => $relation->map(function ($permiso) {
                return $permiso->resource()['data'];
            })];
        }

        // Combina los permisos en las relaciones
        $relationships = array_merge($permisos ?? []);

        // Retorna el array transformado del recurso
        return [
            'id' => $rol->roid,
            'type' => 'rol',
            'attributes' => [
                'activo' => $rol->activo,
                'nombre' => $rol->nombre,
                'descripcion' => $rol->descripcion,
            ],
            'relationships' => $relationships
        ];
    }
}
