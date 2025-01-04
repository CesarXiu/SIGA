<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Http\Traits\ApiTraits;
use App\Http\Traits\UtilTraits;
/**
 * Se define la clase BaseModel que extiende de Model.
 * ESTA CLASE NO SE UTILIZA DIRECTAMENTE, SE UTILIZA PARA QUE LOS DEMAS MODELOS HEREDEN DE ELLA.
 */
class BaseModel extends Model
{
    //Se incluyen los traits que se utilizaran en todos los modelos.
    //HasUuids: Se utiliza para que los modelos tengan un UUID en lugar de un ID.
    //ApiTraits: Se utiliza para que los modelos tengan metodos para la API (filter,scoped,sort...).
    //UtilTraits: Se utiliza para que los modelos utilicen funciones para generar Resources.
    use HasUuids, ApiTraits, UtilTraits;
    //Se define el tipo de conexion que se utilizara.
    protected $connection = 'mysql';
    public $incrementing = false;
    //Para que laravel no inserte fechas automaticamente.
    public $timestamps = false;
    //Se define el tipo de dato que se utilizara para el UUID.
    protected $keyType = 'string';
    // Todos los metodos que implementen UtilTraits tienen que tener esta clase estatica para que funcione correctamente.
    /**
     * //Se define el tipo de recurso que se utilizara en el modelo.
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    protected static function getResourceClass()
    {
        return [];
    }
}
