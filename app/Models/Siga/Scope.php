<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use App\Http\Resources\ScopeResource as Resource;

class Scope extends Model
{
    protected $table = 'scope';
    protected $primaryKey = 'scid';
    protected $attributes = [
        'activo' => true
    ];
    protected $fillable = [
        'nombre', 
        'activo',
        'endpoint'
    ];
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'activo' => 'boolean'
        ];
    }
    public function uniqueIds(): array
    {
        return ['scid'];
    }
    public function getEndPoint(){
        return $this->belongsTo(EndPoint::class, 'endpoint');
    }

    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
