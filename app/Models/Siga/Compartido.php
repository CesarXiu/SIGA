<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;

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
}
