<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudRequest extends FormRequest
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
            'descripcion' => 'required|string',
            'nombre' => 'required|string',
            'correo' => 'required|email',
            'archivos' => 'required|array',
            'archivos.*.nombre' => 'required|string',
            'archivos.*.descripcion' => 'required|string',
            'archivos.*.data' => 'required|array',
            'archivos.*.data.*.nombre' => 'required|string',
            'archivos.*.data.*.descripcion' => 'required|string',
            'archivos.*.data.*.tipo' => 'required|in:int,string,boolean',
            'propietario' => 'required|string|exists:users,id',
        ];
    }
    ////regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|
}
