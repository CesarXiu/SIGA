<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Clase RutaResource
 * 
 * Esta clase extiende de JsonResource y se utiliza para transformar los datos de una ruta en un formato JSON específico.
 */
class RutaResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array asociativo que representa los datos de la ruta.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->ruid, // El identificador único de la ruta.
            'type' => 'ruta', // El tipo de recurso, en este caso 'ruta'.
            'attributes' => [
                'metodo' => $this->metodo, // El método HTTP asociado a la ruta (GET, POST, etc.).
                'descripcion' => $this->descripcion, // Una descripción de la ruta.
                'ruta' => $this->ruta, // La URL o ruta específica.
                'activo' => $this->activo, // Indica si la ruta está activa o no.
                'endpoint' => $this->endpoint, // El endpoint asociado a la ruta.
                'scope' => $this->scope, // El alcance o ámbito de la ruta.
            ],
        ];
    }
}
