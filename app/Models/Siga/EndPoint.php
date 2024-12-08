<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\EndPointResource as Resource;

class EndPoint extends Model
{
    protected $table = 'endpoints';
    protected $primaryKey = 'enid';
    protected $attributes = [
        'activo' => true
    ];
    protected $fillable = [
        'nombre', 
        'descripcion',
        'activo'
    ];
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'nombre' => 'string',
            'descripcion' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['enid'];
    }
    protected $allowIncluded = ['Rutas', 'Scopes'];
    public function getRutas()
    {
        return $this->hasMany(Ruta::class, 'endpoint');
    }
    public function getScopes()
    {
        return $this->hasMany(Scope::class, 'endpoint');
    }
    
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
