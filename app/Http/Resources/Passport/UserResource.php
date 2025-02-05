<?php

namespace App\Http\Resources\Passport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
/**
 * Clase UserResource
 *
 * Esta clase extiende JsonResource y se utiliza para transformar los datos del usuario en un formato de array específico.
 */
class UserResource extends JsonResource
{
    /**
     * Transforma el recurso en un array.
     *
     * @param Request $request La solicitud HTTP actual.
     * @return array<string, mixed> Un array que representa los datos del usuario.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // El identificador único del usuario.
            'type' => 'user', // El tipo de recurso, en este caso 'user'.
            'attributes' => [
                'name' => $this->name, // El nombre del usuario.
                'email' => $this->email, // El correo electrónico del usuario.
                'verified' => $this->email_verified_at !== null, // Si el correo electrónico del usuario ha sido verificado.
                'rol' => $this->rol, // El rol del usuario.
                'created_at' => Carbon::parse($this->created_at)->diffForHumans() // La fecha de creación del usuario en un formato legible.
            ],
        ];
    }
}
