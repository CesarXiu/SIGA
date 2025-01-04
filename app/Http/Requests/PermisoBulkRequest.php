<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase PermisoBulkRequest
 * 
 * Esta clase maneja la validación de solicitudes en masa para permisos.
 * Extiende de FormRequest para utilizar las funcionalidades de validación de Laravel.
 */

class PermisoBulkRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * 
     * @return bool Retorna true si el usuario está autorizado, de lo contrario false.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> 
     *         Un array con las reglas de validación para cada campo.
     */
    public function rules(): array
    {
        return [
            'activo' => 'boolean', // Campo opcional que debe ser un booleano.
            'vista' => 'string|in:basic,complete', // Campo opcional que debe ser una cadena y uno de los valores: basic, complete.
            'rol' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:roles,roid', 
            // Campo requerido que debe ser una cadena, seguir el formato UUID y existir en la tabla roles en la columna roid.
            'scope' => 'required|array', // Campo requerido que debe ser un array.
            'scope.*' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:scope,scid', 
            // Cada elemento del array scope debe ser una cadena, seguir el formato UUID y existir en la tabla scope en la columna scid.
        ];
    }
}
