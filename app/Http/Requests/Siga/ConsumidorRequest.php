<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;
/**
 * Clase ConsumidorRequest
 * 
 * Esta clase maneja la validación y autorización de solicitudes relacionadas con consumidores.
 * Extiende de FormRequest para utilizar las funcionalidades de validación de Laravel.
 */
class ConsumidorRequest extends FormRequest
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
     *         Retorna un arreglo con las reglas de validación para cada campo.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string', // El campo nombre es obligatorio y debe ser una cadena de texto.
            'email' => 'required|email', // El campo email es obligatorio y debe ser un correo electrónico válido.
            'activo' => 'boolean', // El campo activo debe ser un valor booleano.
            'rol' => 'required|string|exists:roles,roid', // El campo rol es obligatorio, debe ser una cadena de texto y existir en la tabla roles.
            'propietario' => 'required|string|exists:users,id', // El campo propietario es obligatorio, debe ser una cadena de texto y existir en la tabla users.
            'solicitud' => 'string|exists:solicitudes,soid', // El campo solicitud es opcional, debe ser una cadena de texto y existir en la tabla solicitudes.
        ];
    }
}
