<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

use App\Http\Resources\SolicitudResource as Resource;
use App\Models\User;
class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'soid';
    public $timestamps = true;
    public function getRouteKeyName()
    {
        return 'soid';
    }

    protected $attributes = [
        'resuelto' => false
    ];
    protected $fillable = [
        'correo', 
        'nombre', 
        'descripcion',
        'resuelto',
        'propietario'
    ];
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'resuelto' => 'boolean',
            'descripcion' => 'string',
            'correo' => 'string'
        ];
    }
    //Relaciones permitidas para incluir en la consulta.
    protected $allowIncluded = ['Modelos'];


    public function modelos($modelos){
        try{
            Modelos::insert($modelos);
        }catch(\Exception $e){
            throw new HttpException(500, 'Error al insertar los modelos');
        }
    }
    public function updateModelos($modelos){
        foreach($modelos as $modelo){
            $model = Modelos::find($modelo['moid']);
            if($model){
                $model->update($modelo);
            }else{
                $model = new Modelos();
                $model->fill($modelo);
                $model->save();
            }
        }
    }

    public function uniqueIds(): array
    {
        return ['soid'];
    }
    public function getPropietario()
    {
        return $this->belongsTo(User::class, 'propietario');
    }
    public function getModelos()
    {
        return $this->hasMany(Modelos::class, 'solicitud');
    }protected static function getResourceClass()
    {
        return Resource::class;
    }
}
