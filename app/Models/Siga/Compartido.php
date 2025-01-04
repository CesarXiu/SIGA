<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Models\User;
use App\Http\Resources\CompartidoResource as Resource;

/**
 * Clase Compartido
 * 
 * Esta clase representa el modelo de un recurso compartido en la aplicación.
 * Define las relaciones, atributos y configuraciones necesarias para interactuar
 * con la base de datos.
 */
class Compartido extends Model
{
    /**
     * @var string $table Nombre de la tabla en la base de datos.
     */
    protected $table = 'compartidos';

    /**
     * @var string $primaryKey Clave primaria de la tabla.
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
        'activo', 
        'usuario',
        'consumidor'
    ];

    /**
     * @var array $allowFilter Atributos permitidos para filtrar.
     */
    protected $allowFilter = [
        'usuario',
        'activo',
        'consumidor'
    ];

    /**
     * @var array $allowIncluded Relaciones permitidas para incluir.
     */
    protected $allowIncluded = [
        'Usuario',
        'Consumidor',
        'Consumidor.getRol',
        'Consumidor.getRol.getPermisos',
        'Consumidor.getRol.getPermisos.getScope',
        'Consumidor.getRol.getPermisos.getScope.getEndPoint',
        'Consumidor.getRol.getPermisos.getScope.getEndPoint.getRutas',
        'Consumidor.getPropietario',
        'Consumidor.getApp'
    ];

    /**
     * Relación con el modelo Consumidor.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getConsumidor()
    {
        return $this->belongsTo(Consumidor::class, 'consumidor', 'coid');
    }

    /**
     * Relación con el modelo User.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getUsuario(){
        return $this->belongsTo(User::class, 'usuario');
    }

    /**
     * Define los tipos de datos de los atributos.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'usuario' => 'string',
            'consumidor' => 'string'
        ];
    }

    /**
     * Define los identificadores únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['coid'];
    }

    /**
     * Obtiene la clase de recurso asociada al modelo.
     * 
     * @return string
     */
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
