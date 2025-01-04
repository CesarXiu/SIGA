<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase SolicitudUpdateRequest
 * 
 * Esta clase maneja la validación y autorización de las solicitudes de actualización.
 * Extiende de FormRequest para utilizar las funcionalidades de validación de Laravel.
 * 
 * @package App\Http\Requests\Siga
 */
class SolicitudUpdateRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para hacer esta solicitud.
     * 
     * @return bool Siempre retorna true, lo que significa que cualquier usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> 
     * Un array asociativo donde las claves son los nombres de los campos y los valores son las reglas de validación.
     * 
     * Reglas de validación:
     * - descripcion: debe ser una cadena de texto.
     * - nombre: debe ser una cadena de texto.
     * - correo: debe ser un correo electrónico válido.
     * - resuelto: debe ser un valor booleano.
     */
    public function rules(): array
    {
        return [
            'descripcion' => 'string',
            'nombre' => 'string',
            'correo' => 'email',
            'resuelto' => 'boolean',
        ];
    }
}

/*'archivos' => 'array',
'archivos.*.moid' => 'required|string|exists:modelos,moid',
'archivos.*.nombre' => 'string',
'archivos.*.descripcion' => 'string',
'archivos.*.data' => 'array',
'archivos.*.data.*.nombre' => 'string',
'archivos.*.data.*.descripcion' => 'string',
'archivos.*.data.*.tipo' => 'in:int,string,boolean'*/
//regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|