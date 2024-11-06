<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\HttpException; 
class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'soid';
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
}
