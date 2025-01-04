<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Clase RolRequest
 * 
 * Esta clase maneja las solicitudes de validación y autorización para la entidad Rol.
 * Extiende de FormRequest para utilizar las funcionalidades de validación de Laravel.
 */
class RolRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado para realizar esta solicitud.
     * 
     * @return bool Retorna verdadero si el rol del usuario es 'admin', de lo contrario retorna falso.
     */
    public function authorize(): bool
    {
        return auth()->user()->rol === 'admin';
    }

    /**
     * Obtiene las reglas de validación que se aplican a la solicitud.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string> 
     *         Retorna un arreglo con las reglas de validación para los campos 'nombre', 'descripcion' y 'activo'.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string', // El campo 'nombre' es obligatorio y debe ser una cadena de texto.
            'descripcion' => 'required|string', // El campo 'descripcion' es obligatorio y debe ser una cadena de texto.
            'activo' => 'boolean', // El campo 'activo' es opcional y debe ser un valor booleano.
        ];
    }
}
