<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

class ConsumidorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'email' => 'required|email',
            'activo' => 'boolean',
            'rol' => 'required|string|exists:roles,roid',
            'propietario' => 'required|string|exists:users,id',
            'solicitud' => 'string|exists:solicitudes,soid',
        ];
    }
}
