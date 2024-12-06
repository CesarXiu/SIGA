<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\PermisoResource as Resource;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $primaryKey = 'peid';
    protected $attributes = [
        'activo' => true,
        'vista' => "basic"
    ];
    protected $fillable = [
        'activo', 
        'vista',
        'rol',
        'scope'
    ];
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'vista' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['peid'];
    }
    public function getRol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }
    public function getScope()
    {
        return $this->belongsTo(Scope::class, 'scope');
    }
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
