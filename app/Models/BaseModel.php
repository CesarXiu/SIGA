<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BaseModel extends Model
{
    use HasUuids;
    protected $connection = 'mysql';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';
}
