<?php

namespace App\Models\Siga;
use App\Models\BaseModel as Model;
use App\Http\Resources\RolResource as Resource;

/**
 * Clase Rol que extiende de Model.
 * 
 * Esta clase representa un rol dentro del sistema y contiene las relaciones y atributos
 * necesarios para su funcionamiento.
 */
class Rol extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'roles';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'roid';

    /**
     * Atributos por defecto del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'activo' => true
    ];

    /**
     * Atributos que se pueden asignar de manera masiva.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 
        'descripcion',
        'activo'
    ];

    /**
     * Definición de los tipos de los atributos.
     *
     * @return array
     */
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'descripcion' => 'string',
            'activo' => 'boolean'
        ];
    }

    /**
     * Identificadores únicos del modelo.
     *
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['roid'];
    }

    /**
     * Relaciones permitidas para ser incluidas.
     *
     * @var array
     */
    protected $allowIncluded = ['Consumidores','Permisos','Permisos.getScope'];

    /**
     * Relación uno a muchos con la clase Consumidor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getConsumidores()
    {
        return $this->hasMany(Consumidor::class, 'rol');
    }

    /**
     * Relación uno a muchos con la clase Permiso.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getPermisos()
    {
        return $this->hasMany(Permiso::class, 'rol');
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
