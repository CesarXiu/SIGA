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
        'activo'
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

    public function resource()
    {
        return ["data" => Resource::make($this)];
    }
    public static function resourceCollection($data)
    {
        return ["data" => Resource::collection($data)];
    }
}
