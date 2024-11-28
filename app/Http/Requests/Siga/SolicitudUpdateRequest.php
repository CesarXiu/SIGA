<?php

namespace App\Http\Requests\Siga;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    *
    * ACTUALIZAR SOLICITUDES
    * SE ACTUALIZA SOLO SOLICITUD
    * ACTUALIZAR MODELOS 
    * SE ACTUALIZAN LOS CAMPOS DE LOS MODELOS Y DATA SE REEMPLAZA
    * ACTUALIZAR CAMPOS
    * SE TIENEN QUE MANDAR TODOS COMPLETOS
    * SOLO SE VA A REEMPLAZAR EL VALOR DE DATA AL ACTUALIZAR ALGUN CAMPO

     */
    public function rules(): array
    {
        return [
            'descripcion' => 'string',
            'nombre' => 'string',
            'correo' => 'email',
            'resuelto' => 'boolean',
            /*'archivos' => 'array',
            'archivos.*.moid' => 'required|string|exists:modelos,moid',
            'archivos.*.nombre' => 'string',
            'archivos.*.descripcion' => 'string',
            'archivos.*.data' => 'array',
            'archivos.*.data.*.nombre' => 'string',
            'archivos.*.data.*.descripcion' => 'string',
            'archivos.*.data.*.tipo' => 'in:int,string,boolean'*/
            //regex:/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$/|
        ];
    }
}
