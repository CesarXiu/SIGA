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
        //$solicitud = $this->resource;
        return [
            'id' => $this->soid,
            'type' => 'solicitud',
            'attributes' => [
                'correo' => $this->correo,
                'descripcion' => $this->descripcion,
                'resuelto' => $this->resuelto,
                'propietario' => $this->propietario,
            ],
        ];
    }
}
