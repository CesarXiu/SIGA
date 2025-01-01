<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Siga\Compartido;

class ConsumidorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $consumidor = $this->resource;
        if ($consumidor->relationLoaded('getApp')) {
            $App = ["App" => $consumidor->getApp->resource()['data']];
        }
        if ($consumidor->relationLoaded('getRol')) {
            $Rol = ["Rol" => $consumidor->getRol->resource()['data']];
        }
        if ($consumidor->relationLoaded('getPropietario')) {
            $Propietario = ["Propietario" => $consumidor->getPropietario->resource()['data']];
        }
        if ($consumidor->relationLoaded('getCompartidos')) {
            $Compartidos = ["Compartidos" => Compartido::resourceCollection($consumidor->getCompartidos)['data']];
        }
        $relationships = array_merge($App ?? [], $Rol ?? [], $Propietario ?? [], $Compartidos ?? []);
        return [ 
            'id' => $consumidor->coid,
            'type' => 'consumidor',
            'attributes' => [
                'nombre' => $consumidor->nombre,
                'email' => $consumidor->email,
                'activo' => $consumidor->activo,
                'appid' => $consumidor->appid,
                'rol' => $consumidor->rol,
                'propietario' => $consumidor->propietario,
                'solicitud' => $consumidor->solicitud,
            ],
            'relationships' => $relationships
        ];
    }
}
