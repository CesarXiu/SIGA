<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Siga\Compartido;

/**
 * Clase ConsumidorResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso de consumidor en un array.
 * Proporciona una representación en formato JSON del recurso Consumidor, incluyendo sus relaciones cargadas.
 */
class ConsumidorResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso Consumidor.
     */
    public function toArray(Request $request): array
    {
        $consumidor = $this->resource;

        // Verifica si la relación 'getApp' está cargada y la agrega al array de relaciones.
        if ($consumidor->relationLoaded('getApp')) {
            $App = ["App" => $consumidor->getApp->resource()['data']];
        }

        // Verifica si la relación 'getRol' está cargada y la agrega al array de relaciones.
        if ($consumidor->relationLoaded('getRol')) {
            $Rol = ["Rol" => $consumidor->getRol->resource()['data']];
        }

        // Verifica si la relación 'getPropietario' está cargada y la agrega al array de relaciones.
        if ($consumidor->relationLoaded('getPropietario')) {
            $Propietario = ["Propietario" => $consumidor->getPropietario->resource()['data']];
        }

        // Verifica si la relación 'getCompartidos' está cargada y la agrega al array de relaciones.
        if ($consumidor->relationLoaded('getCompartidos')) {
            $Compartidos = ["Compartidos" => Compartido::resourceCollection($consumidor->getCompartidos)['data']];
        }

        // Combina todas las relaciones cargadas en un solo array.
        $relationships = array_merge($App ?? [], $Rol ?? [], $Propietario ?? [], $Compartidos ?? []);

        // Retorna el array que representa el recurso Consumidor.
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
