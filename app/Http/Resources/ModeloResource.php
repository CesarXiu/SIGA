<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase ModeloResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar un recurso de modelo en un array.
 * 
 * @package App\Http\Resources
 */

class ModeloResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa el recurso transformado.
     */
    public function toArray(Request $request): array
    {
        $model = $this->resource;
        return [
            'id' => $model->moid, // El ID del modelo.
            'type' => 'modelo', // El tipo de recurso.
            'attributes' => [
                'nombre' => $model->nombre, // El nombre del modelo.
                'descripcion' => $model->descripcion, // La descripción del modelo.
                'solicitud' => $model->solicitud, // La solicitud asociada al modelo.
                'data' => json_decode($model->data), // Los datos del modelo en formato JSON.
            ],
        ];
    }
}
