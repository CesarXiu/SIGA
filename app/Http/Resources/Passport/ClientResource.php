<?php

namespace App\Http\Resources\Passport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * Clase ClientResource
 * 
 * Esta clase extiende JsonResource y se utiliza para transformar los datos del cliente en un array.
 * Específicamente, se utiliza en el contexto de recursos de pasaporte.
 */

class ClientResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa los datos del cliente.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // El ID del cliente.
            'type' => 'client', // El tipo de recurso, en este caso 'client'.
            'attributes' => [
                'user_id' => $this->user_id, // El ID del usuario asociado al cliente.
                'name' => $this->name, // El nombre del cliente.
                'secret' => $this->secret // El secreto del cliente.
            ]
        ];
    }
}
