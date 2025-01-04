<?php

namespace App\Models\Siga;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Siga\Rol;
use App\Models\Passport\Client;
use App\Http\Resources\ConsumidorResource as Resource;
use App\Http\Traits\UtilTraits;
use App\Http\Traits\ApiTraits;
use Laravel\Passport\ClientRepository;
use App\Models\User;


/**
 * Clase Consumidor
 * 
 * Esta clase representa un modelo de consumidor en la aplicación. 
 * Extiende de Authenticatable y utiliza varios traits para proporcionar 
 * funcionalidades adicionales como UUIDs, tokens de API, y utilidades personalizadas.
 * 
 * @property string $table La tabla asociada al modelo.
 * @property string $primaryKey La clave primaria del modelo.
 * @property array $attributes Atributos por defecto del modelo.
 * @property array $fillable Atributos que se pueden asignar masivamente.
 * @property array $allowFilter Atributos permitidos para filtrado.
 * @property array $allowIncluded Relaciones permitidas para inclusión.
 * 
 * @method static getResourceClass() Obtiene la clase de recurso asociada.
 * @method belongsTo getRol() Relación con la clase Rol.
 * @method belongsTo getApp() Relación con la clase Client.
 * @method belongsTo getPropietario() Relación con la clase User.
 * @method hasMany getCompartidos() Relación con la clase Compartido.
 */
class Consumidor extends Authenticatable
{
    //AUTEHNTICATABLE
        use HasUuids, HasApiTokens, UtilTraits, ApiTraits;
        public $incrementing = false; 
        public $timestamps = false;
        protected $keyType = 'string';
    //AUTEHNTICATABLE

    /**
     * @var string $table La tabla asociada al modelo.
     */
    protected $table = 'consumidores';

    /**
     * @var string $primaryKey La clave primaria del modelo.
     */
    protected $primaryKey = 'coid';

    /**
     * @var array $attributes Atributos por defecto del modelo.
     */
    protected $attributes = [
        'activo' => true
    ];

    /**
     * @var array $fillable Atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'email',
        'activo',
        'appid',
        'rol',
        'propietario'
    ];

    /**
     * @var array $allowFilter Atributos permitidos para filtrado.
     */
    public $allowFilter = [
        'nombre',
        'email',
        'activo',
        'appid',
        'rol',
        'propietario'
    ];

    /**
     * Define los tipos de datos de los atributos del modelo.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'email' => 'string',
            'activo' => 'boolean',
            'appid'=> 'string',
            'rol' => 'string',
            'propietario' => 'integer'
        ];
    }

    /**
     * Define los IDs únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['coid'];
    }

    /**
     * @var array $allowIncluded Relaciones permitidas para inclusión.
     */
    protected $allowIncluded = [
        'App', 'Rol','Propietario', 'Compartidos', 'Compartidos.getUsuario',
        'Rol.getPermisos','Rol.getPermisos.getScope','Rol.getPermisos.getScope.getEndPoint',
        'Rol.getPermisos.getScope.getEndPoint.getRutas'
    ];

    /**
     * Relación con la clase Rol.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }

    /**
     * Relación con la clase Client.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getApp(){
        return $this->belongsTo(Client::class, 'appid');
    }

    /**
     * Relación con la clase User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPropietario(){
        return $this->belongsTo(User::class, 'propietario');
    }

    /**
     * Relación con la clase Compartido.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getCompartidos(){
        return $this->hasMany(Compartido::class, 'consumidor', 'coid');
    }

    /**
     * Obtiene la clase de recurso asociada.
     * 
     * @return string
     */
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
