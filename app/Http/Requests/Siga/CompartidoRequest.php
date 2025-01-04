<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase CompartidoRequest
 * 
 * Esta clase maneja la validación de las solicitudes relacionadas con la entidad "Compartido".
 * Extiende de FormRequest para aprovechar las funcionalidades de validación y autorización.
 */

class CompartidoRequest extends FormRequest
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
     *         Un array de reglas de validación.
     */
    public function rules(): array
    {
        return [
            'usuario' => 'required|string|exists:users,email', // El campo 'usuario' es obligatorio, debe ser una cadena y existir en la tabla 'users' en la columna 'email'.
            'consumidor' => 'required|string|exists:consumidores,coid', // El campo 'consumidor' es obligatorio, debe ser una cadena y existir en la tabla 'consumidores' en la columna 'coid'.
            'activo' => 'boolean' // El campo 'activo' es opcional y debe ser un valor booleano.
        ];
    }
}
