<?php

namespace App\Models\Siga;
use App\Models\BaseModel as Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'roid';
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
            'nombre' => 'string',
            'descripcion' => 'string',
            'activo' => 'boolean'
        ];
    }
    public function uniqueIds(): array
    {
        return ['roid'];
    }
    public function consumidores()
    {
        return $this->hasMany(Consumidor::class, 'rol');
    }
}
