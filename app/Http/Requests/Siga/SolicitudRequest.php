<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase SolicitudRequest
 * 
 * Esta clase maneja la validación de las solicitudes entrantes en la aplicación.
 * Extiende de FormRequest para utilizar las funcionalidades de validación de Laravel.
 */
class SolicitudRequest extends FormRequest
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
     *         Un arreglo asociativo donde las claves son los nombres de los campos y los valores son las reglas de validación.
     */
    public function rules(): array
    {
        return [
            'descripcion' => 'required|string', // La descripción es obligatoria y debe ser una cadena de texto.
            'nombre' => 'required|string', // El nombre es obligatorio y debe ser una cadena de texto.
            'correo' => 'required|email', // El correo es obligatorio y debe ser una dirección de correo válida.
            'archivos' => 'required|array', // Los archivos son obligatorios y deben ser un arreglo.
            'archivos.*.nombre' => 'required|string', // El nombre de cada archivo es obligatorio y debe ser una cadena de texto.
            'archivos.*.descripcion' => 'required|string', // La descripción de cada archivo es obligatoria y debe ser una cadena de texto.
            'archivos.*.data' => 'required|array', // Los datos de cada archivo son obligatorios y deben ser un arreglo.
            'archivos.*.data.*.nombre' => 'required|string', // El nombre de cada dato de archivo es obligatorio y debe ser una cadena de texto.
            'archivos.*.data.*.descripcion' => 'required|string', // La descripción de cada dato de archivo es obligatoria y debe ser una cadena de texto.
            'archivos.*.data.*.tipo' => 'required|in:int,string,boolean', // El tipo de cada dato de archivo es obligatorio y debe ser uno de los valores especificados (int, string, boolean).
            'propietario' => 'required|string|exists:users,id', // El propietario es obligatorio, debe ser una cadena de texto y debe existir en la tabla de usuarios.
        ];
    }
    ////regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|
}
