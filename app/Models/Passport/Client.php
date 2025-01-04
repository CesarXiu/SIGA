<?php

namespace App\Models\Passport;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UtilTraits;
use App\Http\Resources\Passport\ClientResource as Resource;

/**
 * Clase Client
 * 
 * Esta clase representa un cliente OAuth en el sistema. Extiende de la clase Model y utiliza el trait UtilTraits.
 * 
 * @package App\Models\Passport
 */
class Client extends Model
{
    use UtilTraits;

    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    /**
     * Llave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si la llave primaria es auto-incremental.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Indica si el modelo tiene marcas de tiempo.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Tipo de la llave primaria.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'secret'
    ];

    /**
     * Obtiene la clase del recurso asociada al modelo.
     *
     * @return string
     */
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
