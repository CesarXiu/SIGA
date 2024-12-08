<?php

namespace App\Models\Siga;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\Siga\Rol;
use App\Models\Passport\Client;
use App\Http\Resources\ConsumidorResource as Resource;
use App\Http\Traits\UtilTraits;
use App\Http\Traits\ApiTraits;
use Laravel\Passport\ClientRepository;


class Consumidor extends Authenticatable
{
    //AUTEHNTICATABLE
        use HasUuids,HasApiTokens, UtilTraits, ApiTraits;
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
    protected $allowIncluded = ['App', 'Rol'];
    public function getRol()
    {
        return $this->belongsTo(Rol::class, 'rol');
    }
    public function getApp(){
        return $this->belongsTo(Client::class, 'appid');
    }
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
