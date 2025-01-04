<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ScopeRequest
 * 
 * Esta clase maneja las solicitudes de validación y autorización para las operaciones relacionadas con el alcance (scope) en la aplicación.
 * Extiende de FormRequest para utilizar las funcionalidades de validación y autorización de Laravel.
 */
class ScopeRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * 
     * @return bool Retorna verdadero si el rol del usuario es 'admin', de lo contrario, retorna falso.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol === 'admin';
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     * 
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> 
     * Retorna un arreglo de reglas de validación para los campos de la solicitud.
     * - 'nombre': Campo requerido de tipo string.
     * - 'activo': Campo booleano opcional.
     * - 'endpoint': Campo requerido de tipo string que debe existir en la tabla 'endpoints' en la columna 'enid'.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'activo' => 'boolean',
            'endpoint' => 'required|string|exists:endpoints,enid'
        ];
    }
}
