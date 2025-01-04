<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\RutaResource as Resource;
/**
 * Clase Ruta
 * 
 * Esta clase representa una ruta en el sistema y extiende de la clase Model.
 * Se utiliza para interactuar con la tabla 'rutas' en la base de datos.
 * 
 * @property string $table Nombre de la tabla en la base de datos.
 * @property string $primaryKey Clave primaria de la tabla.
 * @property array $attributes Atributos predeterminados del modelo.
 * @property array $fillable Atributos que se pueden asignar masivamente.
 * 
 * @method array casts() Define los tipos de datos de los atributos.
 * @method array uniqueIds() Devuelve los identificadores únicos del modelo.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo getEndpoint() Relación con el modelo EndPoint.
 * @method \Illuminate\Database\Eloquent\Relations\BelongsTo getScope() Relación con el modelo Scope.
 * @method string getResourceClass() Devuelve la clase de recurso asociada.
 */
class Ruta extends Model
{
    protected $table = 'rutas'; // Nombre de la tabla en la base de datos.
    protected $primaryKey = 'ruid'; // Clave primaria de la tabla.
    protected $attributes = [
        'activo' => true // Atributo predeterminado 'activo' con valor true.
    ];
    protected $fillable = [
        'metodo', 
        'descripcion',
        'ruta',
        'activo',
        'endpoint',
        'scope'
    ]; // Atributos que se pueden asignar masivamente.
    
    /**
     * Define los tipos de datos de los atributos.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'metodo' => 'string',
            'descripcion' => 'string',
            'ruta' => 'string'
        ];
    }

    /**
     * Devuelve los identificadores únicos del modelo.
     * 
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['ruid'];
    }

    /**
     * Relación con el modelo EndPoint.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getEndpoint()
    {
        return $this->belongsTo(EndPoint::class, 'endpoint');
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
     * Devuelve la clase de recurso asociada.
     * 
     * @return string
     */
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
