<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\ScopeResource as Resource;

/**
 * Clase Scope
 * 
 * Esta clase representa el modelo de un alcance (scope) en la aplicación.
 * Extiende de la clase base Model y define las propiedades y métodos
 * necesarios para interactuar con la base de datos.
 */
class Scope extends Model
{
    /**
     * @var string $table Nombre de la tabla en la base de datos.
     */
    protected $table = 'scope';

    /**
     * @var string $primaryKey Nombre de la clave primaria de la tabla.
     */
    protected $primaryKey = 'scid';

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
        'activo',
        'endpoint'
    ];

    /**
     * Define los tipos de datos que deben ser convertidos.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'activo' => 'boolean'
        ];
    }

    /**
     * Define los identificadores únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['scid'];
    }

    /**
     * Define la relación con el modelo EndPoint.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getEndPoint(){
        return $this->belongsTo(EndPoint::class, 'endpoint');
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
