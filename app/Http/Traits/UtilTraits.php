<?php
namespace App\Http\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait UtilTraits
{
    public static function resourceCollection($data)
    {
        return ["data" => static::getResourceClass()::collection($data)];
    }

    public function resource()
    {
        return ["data" => static::getResourceClass()::make($this)];
    }

    abstract protected static function getResourceClass();
}