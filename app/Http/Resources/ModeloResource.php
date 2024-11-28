<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModeloResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $model = $this->resource;
        return [
            'id' => $model->moid,
            'type' => 'modelo',
            'attributes' => [
                'nombre' => $model->nombre,
                'descripcion' => $model->descripcion,
                'solicitud' => $model->solicitud,
                'data' => json_decode($model->data),
            ],
        ];
    }
}
