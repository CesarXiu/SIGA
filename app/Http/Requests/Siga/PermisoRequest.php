<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PermisoRequest
 *
 * Esta clase maneja la validación y autorización de solicitudes relacionadas con permisos en la aplicación.
 * Extiende de FormRequest para utilizar las funcionalidades de validación y autorización de Laravel.
 */
class PermisoRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     *
     * @return bool Retorna verdadero si el usuario tiene el rol de 'admin', de lo contrario, retorna falso.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol === 'admin';
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Un array con las reglas de validación.
     */
    public function rules(): array
    {
        return [
            'activo' => 'boolean', // Campo opcional que debe ser un booleano.
            'vista' => 'string|in:basic,complete', // Campo opcional que debe ser una cadena y puede ser 'basic' o 'complete'.
            'rol' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:roles,roid', // Campo requerido que debe ser una cadena con formato UUID y existir en la tabla 'roles' en la columna 'roid'.
            'scope' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:scope,scid', // Campo requerido que debe ser una cadena con formato UUID y existir en la tabla 'scope' en la columna 'scid'.
        ];
    }
}
