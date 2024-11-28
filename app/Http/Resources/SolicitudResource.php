<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $solicitud = $this->resource;
        if ($solicitud->relationLoaded('getModelos')) {
            $modelos = ["modelos" => $solicitud->getModelos->map(function ($modelo) {
                return [
                    'moid' => $modelo->moid,
                    'nombre' => $modelo->nombre,
                    'descripcion' => $modelo->descripcion,
                    'campos' => json_decode($modelo->data),
                ];
            })];
        }
        $relationships = array_merge($modelos ?? []);
        return [
            'id' => $solicitud->soid,
            'type' => 'solicitud',
            'attributes' => [
                'nombre' => $solicitud->nombre,
                'correo' => $solicitud->correo,
                'descripcion' => $solicitud->descripcion,
                'resuelto' => $solicitud->resuelto,
                'propietario' => $solicitud->propietario,
            ],
            'relationships' => $relationships
        ];
    }
}
