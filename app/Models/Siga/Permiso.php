<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\PermisoResource as Resource;

/**
 * Clase Permiso
 * 
 * Esta clase representa un modelo de Permiso en la aplicación. 
 * Define la estructura de la tabla 'permisos' y sus relaciones con otras tablas.
 * 
 * @package App\Models\Siga
 */

class Permiso extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     * 
     * @var string
     */
    protected $table = 'permisos';

    /**
     * Clave primaria de la tabla.
     * 
     * @var string
     */
    protected $primaryKey = 'peid';

    /**
     * Atributos por defecto del modelo.
     * 
     * @var array
     */
    protected $attributes = [
        'activo' => true,
        'vista' => "basic"
    ];

    /**
     * Atributos que se pueden asignar masivamente.
     * 
     * @var array
     */
    protected $fillable = [
        'activo', 
        'vista',
        'rol',
        'scope'
    ];

    /**
     * Define los tipos de datos de los atributos.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'vista' => 'string'
        ];
    }

    /**
     * Define los identificadores únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['peid'];
    }

    /**
     * Relaciones permitidas para ser incluidas.
     * 
     * @var array
     */
    protected $allowIncluded = ['Rol','Scope'];

    /**
     * Relación con el modelo Rol.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getRol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }

    /**
     * Relación con el modelo Scope.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getScope()
    {
        return $this->belongsTo(Scope::class, 'scope');
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
