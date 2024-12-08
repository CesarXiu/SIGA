<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermisoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permiso = $this->resource;
        if ($permiso->relationLoaded('getScope')) {
            $relation = $permiso->getScope;
            $scopes = ["Scopes" => $relation->resource()['data']];
        }
        $relationships = array_merge($scopes ?? []);
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
