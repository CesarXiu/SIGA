<?php

namespace App\Models\Siga;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

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
}
