<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase ModeloRequest
 * 
 * Esta clase extiende de FormRequest y se utiliza para manejar las solicitudes de validación 
 * de datos para el modelo en el contexto de la aplicación SIGA.
 */
class ModeloRequest extends FormRequest
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
     *         Un array asociativo donde las claves son los nombres de los campos y los valores 
     *         son las reglas de validación correspondientes.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string', // El campo nombre es obligatorio y debe ser una cadena de texto.
            'descripcion' => 'required|string', // El campo descripcion es obligatorio y debe ser una cadena de texto.
            'data' => 'required|array', // El campo data es obligatorio y debe ser un array.
            'data.*.nombre' => 'required|string', // Cada elemento del array data debe tener un campo nombre que es obligatorio y debe ser una cadena de texto.
            'data.*.descripcion' => 'required|string', // Cada elemento del array data debe tener un campo descripcion que es obligatorio y debe ser una cadena de texto.
            'data.*.tipo' => 'required|string', // Cada elemento del array data debe tener un campo tipo que es obligatorio y debe ser una cadena de texto.
            'solicitud' => 'required|string|regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|exists:solicitudes,soid' 
            // El campo solicitud es obligatorio, debe ser una cadena de texto, debe coincidir con el formato UUID y debe existir en la tabla solicitudes en la columna soid.
        ];
    }
}
