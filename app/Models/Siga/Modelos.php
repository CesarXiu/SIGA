<?php

namespace App\Models\Siga;
use App\Models\BaseModel as Model;
use App\Http\Resources\ModeloResource as Resource;
use App\Http\Traits\UtilTraits;
/**
 * Clase Modelos
 * 
 * Esta clase representa el modelo de datos para la tabla 'modelos' en la base de datos.
 * Utiliza traits y proporciona métodos para la manipulación y almacenamiento de datos
 * relacionados con los modelos.
 */
class Modelos extends Model
{   
    use UtilTraits;

    /**
     * @var string $table Nombre de la tabla en la base de datos.
     */
    protected $table = 'modelos';

    /**
     * @var string $resource Clase de recurso asociada.
     */
    protected $resource = Resource::class;

    /**
     * @var string $primaryKey Clave primaria de la tabla.
     */
    protected $primaryKey = 'moid';

    /**
     * @var array $fillable Atributos que son asignables en masa.
     */
    protected $fillable = [
        'nombre', 
        'descripcion',
        'data',
        'solicitud'
    ];

    /**
     * @var array $allowFilter Atributos permitidos para filtrar.
     */
    public $allowFilter = [
        'nombre', 
        'descripcion',
        'solicitud'
    ];

    /**
     * Define los tipos de datos para los atributos del modelo.
     * 
     * @return array
     */
    protected function casts(): array
    {
        return [
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
        return ['moid'];
    }

    /**
     * Almacena datos en formato JSON.
     * 
     * @param mixed $json Datos a almacenar en formato JSON.
     */
    public function storeData($json){
        $this->data = json_encode($json);
    }

    /**
     * Obtiene los datos almacenados en formato JSON.
     * 
     * @return mixed
     */
    private function getData(){
        return json_decode($this->data);
    }

    /**
     * Define la relación con la clase Solicitud.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getSolicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud');
    }

    /**
     * Crea una nueva instancia del modelo y la guarda en la base de datos.
     * 
     * @param array $modelo Datos del modelo a crear.
     * @return Modelos
     */
    public static function createModelo($modelo){
        $model = new Modelos();
        $model->nombre = $modelo['nombre'];
        $model->descripcion = $modelo['descripcion'];
        $model->solicitud = $modelo['solicitud'];
        $model->storeData($modelo['data']);
        $model->save();
        return $model;
    }

    /**
     * Actualiza la instancia del modelo con nuevos datos y la guarda en la base de datos.
     * 
     * @param array $modelo Datos del modelo a actualizar.
     */
    public function updateModelo($modelo){
        $this->nombre = $modelo['nombre'];
        $this->descripcion = $modelo['descripcion'];
        $this->storeData($modelo['data']);
        $this->save();
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
