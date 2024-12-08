<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Models\Siga\Modelos;


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
            $relation = $solicitud->getModelos;
            $modelos = ["modelos" => $relation->map(function ($modelo) {
                return $modelo->resource()['data'];
            })];
        }
        if ($solicitud->relationLoaded('getPropietario')) {
            $prop = $solicitud->getPropietario;
            $propietario = ["propietario" => [
                'id' => $prop->id,
                'type' => 'user',
                'attributes' => [
                    'name' => $prop->name,
                    'email' => $prop->email,
                    'created_at' => Carbon::parse($prop->created_at)->diffForHumans()
                ]
            ]];
        }
        if ($solicitud->relationLoaded('getConsumidor')) {
            $consumer = $solicitud->getConsumidor;
            if($consumer){
                $consumidor = ["consumidor" => $consumer->resource()['data']];
            }
        }
        $relationships = array_merge($modelos ?? [], $propietario ?? [], $consumidor ?? []);
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
