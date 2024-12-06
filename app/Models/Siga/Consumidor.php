<?php

namespace App\Models\Siga;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Siga\Rol;
use App\Http\Resources\ConsumidorResource as Resource;


class Consumidor extends Authenticatable
{
    //AUTEHNTICATABLE
        use HasUuids,HasApiTokens;
        public $incrementing = false;
        public $timestamps = false;
        protected $keyType = 'string';
    //AUTEHNTICATABLE
    protected $table = 'consumidores';
    protected $primaryKey = 'coid';
    protected $attributes = [
        'activo' => true
    ];
    protected $fillable = [
        'nombre',
        'email',
        'activo',
        'appid',
        'rol',
        'propietario'
    ];
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'email' => 'string',
            'activo' => 'boolean',
            'appid'=> 'string',
            'rol' => 'string',
            'propietario' => 'integer'
        ];
    }
    public function uniqueIds(): array
    {
        return ['coid'];
    }

    public function getRol(): BelongsTo
    {
        //\Log::info('Entramos a la relacion');
        return $this->belongsTo(Rol::class, 'rol');
    }
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
