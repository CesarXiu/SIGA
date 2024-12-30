<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

class CompartidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->id === $this->input('usuario') || 
                auth()->user()->rol === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'usuario' => 'required|string|exists:users,id',
            'consumidor' => 'required|string|exists:consumidores,coid',
            'activo' => 'boolean'
        ];
    }
}
