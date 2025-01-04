<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\EndPointResource as Resource;

/**
 * Clase EndPoint
 * 
 * Esta clase representa un modelo de un endpoint en la base de datos. 
 * Extiende de la clase Model y define varias propiedades y métodos 
 * relacionados con los endpoints.
 */
class EndPoint extends Model
{
    /**
     * @var string $table Nombre de la tabla en la base de datos.
     */
    protected $table = 'endpoints';

    /**
     * @var string $primaryKey Clave primaria de la tabla.
     */
    protected $primaryKey = 'enid';

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
        'descripcion',
        'activo'
    ];

    /**
     * Define los tipos de datos de los atributos del modelo.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'nombre' => 'string',
            'descripcion' => 'string'
        ];
    }

    /**
     * Define los identificadores únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['enid'];
    }

    /**
     * @var array $allowIncluded Relaciones permitidas para incluir.
     */
    protected $allowIncluded = ['Rutas', 'Scopes'];

    /**
     * @var array $allowFilters Filtros permitidos para el modelo.
     */
    protected $allowFilters = ['nombre', 'descripcion'];

    /**
     * Define la relación uno a muchos con el modelo Ruta.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getRutas()
    {
        return $this->hasMany(Ruta::class, 'endpoint');
    }

    /**
     * Define la relación uno a muchos con el modelo Scope.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getScopes()
    {
        return $this->hasMany(Scope::class, 'endpoint');
    }
    
    /**
     * Obtiene la clase de recurso asociada con el modelo.
     * 
     * @return string
     */
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
