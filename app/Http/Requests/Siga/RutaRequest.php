<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase RutaRequest
 * 
 * Esta clase extiende de FormRequest y se utiliza para manejar la validación y autorización
 * de las solicitudes relacionadas con las rutas en la aplicación SIGA.
 */
class RutaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * 
     * @return bool Retorna verdadero si el rol del usuario es 'admin', de lo contrario falso.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol === 'admin';
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
            'descripcion' => 'required|string', // La descripción es obligatoria y debe ser una cadena de texto.
            'metodo' => 'required|string|in:GET,POST,PUT,DELETE', // El método es obligatorio, debe ser una cadena y uno de los valores permitidos.
            'ruta' => 'required|string|regex:/^\/?(api\/)?[a-z0-9\-\/\{\}]+$/', // La ruta es obligatoria, debe ser una cadena y cumplir con el formato especificado por la expresión regular.
            'activo' => 'boolean', // El campo activo es opcional y debe ser un valor booleano.
            'endpoint' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:endpoints,enid', // El endpoint es obligatorio, debe ser una cadena, cumplir con el formato UUID y existir en la tabla endpoints.
            'scope' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:scope,scid' // El scope es obligatorio, debe ser una cadena, cumplir con el formato UUID y existir en la tabla scope.
        ];
    }
}
