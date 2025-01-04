<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

use App\Http\Resources\SolicitudResource as Resource; //Resource para el modelo.
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\HttpException;


/**
 * Clase Solicitud que extiende de Model.
 * 
 * Esta clase representa una solicitud en el sistema y contiene las propiedades y métodos
 * necesarios para gestionar las solicitudes.
 */
class Solicitud extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'solicitudes';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'soid';

    /**
     * Indica si el modelo debe gestionar las marcas de tiempo.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Obtiene el nombre de la clave de ruta para el modelo.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'soid';
    }

    /**
     * Atributos predeterminados del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'resuelto' => false
    ];

    /**
     * Filtros permitidos para el modelo.
     *
     * @var array
     */
    public $allowFilter = [
        'correo',
        'nombre',
        'descripcion',
        'resuelto',
        'propietario'
    ];

    /**
     * Campos permitidos para ordenar.
     *
     * @var array
     */
    protected $allowSort = [
        'resuelto',
        'created_at'
    ];

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'correo', 
        'nombre', 
        'descripcion',
        'resuelto',
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
            'resuelto' => 'boolean',
            'descripcion' => 'string',
            'correo' => 'string'
        ];
    }

    /**
     * Inserta múltiples modelos en la base de datos.
     *
     * @param array $modelos
     * @throws HttpException
     */
    public function modelos($modelos)
    {
        try {
            Modelos::insert($modelos);
        } catch (\Exception $e) {
            throw new HttpException(500, 'Error al insertar los modelos');
        }
    }

    /**
     * Actualiza múltiples modelos en la base de datos.
     *
     * @param array $modelos
     */
    public function updateModelos($modelos)
    {
        foreach ($modelos as $modelo) {
            $model = Modelos::find($modelo['moid']);
            if ($model) {
                $model->update($modelo);
            } else {
                $model = new Modelos();
                $model->fill($modelo);
                $model->save();
            }
        }
    }

    /**
     * Obtiene los identificadores únicos del modelo.
     *
     * @return array
     */
    public function uniqueIds(): array
    {
        return ['soid'];
    }

    /**
     * Relaciones permitidas para incluir en la consulta.
     *
     * @var array
     */
    protected $allowIncluded = ['Modelos','Propietario','Consumidor','Consumidor.getRol'];

    /**
     * Define la relación con el propietario de la solicitud.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getPropietario()
    {
        return $this->belongsTo(User::class, 'propietario');
    }

    /**
     * Define la relación con los modelos asociados a la solicitud.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getModelos()
    {
        return $this->hasMany(Modelos::class, 'solicitud');
    }

    /**
     * Define la relación con el consumidor asociado a la solicitud.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function getConsumidor()
    {
        return $this->belongsTo(Consumidor::class, 'consumidor');
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
