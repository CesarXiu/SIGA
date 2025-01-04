<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase CompartidoBulkUpdate
 * 
 * Esta clase maneja la validación y autorización de solicitudes para la actualización masiva de registros en la entidad "compartidos".
 * Extiende de FormRequest para aprovechar las funcionalidades de validación y autorización de Laravel.
 */
class CompartidoBulkUpdate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> Un array con las reglas de validación.
     */
    public function rules(): array
    {
        return [
            // 'compartidos' es requerido y debe ser un array.
            'compartidos' => 'required|array',
            
            // Cada elemento del array 'compartidos' debe tener un campo 'id' que sea un string con formato UUID y debe existir en la tabla 'compartidos' en la columna 'coid'.
            'compartidos.*.id' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:compartidos,coid',
            
            // Cada elemento del array 'compartidos' debe tener un campo 'activo' que sea booleano y es requerido.
            'compartidos.*.activo' => 'required|boolean',
        ];
    }
}
