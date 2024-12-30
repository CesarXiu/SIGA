<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\CompartidoResource as Resource;

class Compartido extends Model
{
    protected $table = 'compartidos';
    protected $primaryKey = 'coid';
    protected $attributes = [
        'activo' => true
    ];
    protected $fillable = [
        'activo', 
        'usuario',
        'consumidor'
    ];
    protected $allowFilter = [
        'usuario',
        'activo',
        'consumidor'
    ];
    protected $allowIncluded = [
        'Consumidor',
        'Consumidor.getRol',
        'Consumidor.getRol.getPermisos',
        'Consumidor.getRol.getPermisos.getScope',
        'Consumidor.getRol.getPermisos.getScope.getEndPoint',
        'Consumidor.getRol.getPermisos.getScope.getEndPoint.getRutas',
        'Consumidor.getPropietario',
        'Consumidor.getApp'
    ];
    //Rol.getPermisos.getScope.getEndPoint.getRutas,Propietario,App
    public function getConsumidor()
    {
        return $this->belongsTo(Consumidor::class, 'consumidor', 'coid');
    }
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'usuario' => 'string',
            'consumidor' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['coid'];
    }
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
