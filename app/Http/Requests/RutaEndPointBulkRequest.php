<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase RutaEndPointBulkRequest
 * 
 * Esta clase maneja la validación y autorización de solicitudes masivas relacionadas con rutas y endpoints.
 * Extiende de FormRequest para aprovechar las funcionalidades de validación y autorización de Laravel.
 */
class RutaEndPointBulkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> 
     *         Retorna un arreglo con las reglas de validación para los campos 'endpoint' y 'rutas'.
     *         - 'endpoint': Debe ser un string requerido que cumpla con el formato UUID y existir en la tabla 'endpoints' en la columna 'enid'.
     *         - 'rutas': Debe ser un arreglo requerido.
     *         - 'rutas.*': Cada elemento del arreglo 'rutas' debe ser un string requerido que cumpla con el formato UUID y existir en la tabla 'rutas' en la columna 'ruid'.
     */
    public function rules(): array
    {
        return [
            'endpoint' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:endpoints,enid',
            'rutas' => 'required|array',
            'rutas.*' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:rutas,ruid',
        ];
    }
}
