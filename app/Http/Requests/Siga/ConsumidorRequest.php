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
            'appid' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:oauth_clients,id',
            'propietario' => 'required|string|exists:users,id',
        ];
    }
}
