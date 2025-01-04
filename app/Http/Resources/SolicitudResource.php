<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Siga\Modelos;


/**
 * Clase SolicitudResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar una instancia de Solicitud en un array que puede ser convertido a JSON.
 * 
 * @package App\Http\Resources
 */

class SolicitudResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa la instancia de Solicitud.
     */
    public function toArray(Request $request): array
    {
        $solicitud = $this->resource;

        // Verifica si la relación 'getModelos' está cargada y la transforma en un array.
        if ($solicitud->relationLoaded('getModelos')) {
            $relation = $solicitud->getModelos;
            $modelos = ["modelos" => $relation->map(function ($modelo) {
                return $modelo->resource()['data'];
            })];
        }

        // Verifica si la relación 'getPropietario' está cargada y la transforma en un array.
        if ($solicitud->relationLoaded('getPropietario')) {
            $prop = $solicitud->getPropietario;
            $propietario = ["propietario" => $prop->resource()['data']];
        }

        // Verifica si la relación 'getConsumidor' está cargada y la transforma en un array.
        if ($solicitud->relationLoaded('getConsumidor')) {
            $consumer = $solicitud->getConsumidor;
            if($consumer){
                $consumidor = ["consumidor" => $consumer->resource()['data']];
            }
        }

        // Combina todas las relaciones cargadas en un solo array.
        $relationships = array_merge($modelos ?? [], $propietario ?? [], $consumidor ?? []);

        // Retorna el array que representa la instancia de Solicitud.
        return [
            'id' => $solicitud->soid,
            'type' => 'solicitud',
            'attributes' => [
                'nombre' => $solicitud->nombre,
                'correo' => $solicitud->correo,
                'descripcion' => $solicitud->descripcion,
                'resuelto' => $solicitud->resuelto,
                'propietario' => $solicitud->propietario,
                'created_at' => Carbon::parse($solicitud->created_at)->diffForHumans()
            ],
            'relationships' => $relationships
        ];
    }
}
