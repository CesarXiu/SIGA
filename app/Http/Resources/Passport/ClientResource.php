<?php

namespace App\Http\Resources\Passport;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'client',
            'attributes' => [
                'user_id' => $this->user_id,
                'name' => $this->name,
                'secret' => $this->secret
            ]
        ];
    }
}
