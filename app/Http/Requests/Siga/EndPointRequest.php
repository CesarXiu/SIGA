<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Esta clase EndPointRequest extiende de FormRequest y se utiliza para manejar 
 * las solicitudes HTTP relacionadas con los endpoints en la aplicación SIGA.
 * Se encarga de autorizar al usuario y de definir las reglas de validación 
 * para los datos de la solicitud.
 */
class EndPointRequest extends FormRequest
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
     *         Un array asociativo donde las claves son los nombres de los campos y los valores son las reglas de validación.
     */
    public function rules(): array
    {
        return [
            'nombre' => 'required|string', // El campo 'nombre' es obligatorio y debe ser una cadena de texto.
            'descripcion' => 'required|string', // El campo 'descripcion' es obligatorio y debe ser una cadena de texto.
            'activo' => 'boolean' // El campo 'activo' es opcional y debe ser un valor booleano.
        ];
    }
}
