<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

class Ruta extends Model
{
    protected $table = 'rutas';
    protected $primaryKey = 'ruid';
    protected $attributes = [
        'activo' => true
    ];
    protected $fillable = [
        'metodo', 
        'descripcion',
        'ruta',
        'activo',
        'endpoint',
        'scope'
    ];
    protected function casts(): array
    {
        return [
            'activo' => 'boolean',
            'metodo' => 'string',
            'descripcion' => 'string',
            'ruta' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['ruid'];
    }
    public function getEndpoint()
    {
        return $this->belongsTo(EndPoint::class, 'endpoint');
    }
    public function getScope()
    {
        return $this->belongsTo(Scope::class, 'scope');
    }
}
