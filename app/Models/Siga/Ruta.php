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
        'nombre', 
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
            'nombre' => 'string',
            'descripcion' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['enid'];
    }
    public function getRutas()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }
}
