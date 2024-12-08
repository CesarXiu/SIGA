<?php

namespace App\Models\Passport;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\UtilTraits;
use App\Http\Resources\Passport\ClientResource as Resource;

class Client extends Model
{
    use UtilTraits;
    protected $table = 'oauth_clients';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'name',
        'secret'
    ];
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
