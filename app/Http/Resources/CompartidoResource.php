<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase CompartidoResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso Compartido en un array.
 * 
 * @package App\Http\Resources
 */
class CompartidoResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> El recurso transformado en un array.
     */
    public function toArray(Request $request): array
    {
        $compartido = $this->resource;

        // Verifica si la relación 'getConsumidor' está cargada y la agrega al array de relaciones.
        if ($compartido->relationLoaded('getConsumidor')) {
            $consumidor = ["Consumidor" => $compartido->getConsumidor->resource()['data']];
        }

        // Verifica si la relación 'getUsuario' está cargada y la agrega al array de relaciones.
        if ($compartido->relationLoaded('getUsuario')) {
            $usuario = ["Usuario" => $compartido->getUsuario->resource()['data']];
        }

        // Combina las relaciones cargadas en un solo array.
        $relationships = array_merge($consumidor ?? [], $usuario ?? []);

        // Retorna el recurso transformado en un array.
        return [
            'id' => $compartido->coid,
            'type' => 'compartido',
            'attributes' => [
                'activo' => $compartido->activo,
                'usuario' => $compartido->usuario,
                'consumidor' => $compartido->consumidor,
            ],
            'relationships' => $relationships
        ];
    }
}
