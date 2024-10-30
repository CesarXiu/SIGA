<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

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
    public function getRutas()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }
}
