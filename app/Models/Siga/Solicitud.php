<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

use App\Http\Resources\SolicitudResource as Resource;
use App\Models\User;
class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'soid';
    public function getRouteKeyName()
    {
        return 'soid';
    }

    protected $attributes = [
        'resuelto' => false
    ];
    protected $fillable = [
        'correo', 
        'descripcion',
        'resuelto',
        'propietario'
    ];
    protected function casts(): array
    {
        return [
            'resuelto' => 'boolean',
            'descripcion' => 'string',
            'correo' => 'string'
        ];
    }

    public function modelos($modelos){
        try{
            Modelos::insert($modelos);
        }catch(\Exception $e){
            throw new HttpException(500, 'Error al insertar los modelos');
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
    }
    public static function resourceCollection($data)
    {
        return ["data" => Resource::collection($data)];
    }
    public function resource()
    {
        return ["data" => Resource::make($this)];
    }
}
