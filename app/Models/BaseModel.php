<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Http\Traits\ApiTraits;

class BaseModel extends Model
{
    //Se incluyen los traits que se utilizaran en todos los modelos.
    //HasUuids: Se utiliza para que los modelos tengan un UUID en lugar de un ID.
    use HasUuids, ApiTraits;
    //Se define el tipo de conexion que se utilizara.
    protected $connection = 'mysql';
    public $incrementing = false;
    //Para que laravel no inserte fechas automaticamente.
    public $timestamps = false;
    //Se define el tipo de dato que se utilizara para el UUID.
    protected $keyType = 'string';
}
