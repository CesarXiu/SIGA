<?php

namespace App\Models\Siga;
use App\Models\BaseModel as Model;
use App\Http\Resources\ModeloResource as Resource;
use App\Http\Traits\UtilTraits;
class Modelos extends Model
{   
    use UtilTraits;
    protected $table = 'modelos';
    protected $resource = Resource::class;
    protected $primaryKey = 'moid';
    /*protected $attributes = [
        'data' => null
    ];*/
    protected $fillable = [
        'nombre', 
        'descripcion',
        'data',
        'solicitud'
    ];
    public $allowFilter = [
        'nombre', 
        'descripcion',
        'solicitud'
    ];
    protected function casts(): array
    {
        return [
            'nombre' => 'string',
            'descripcion' => 'string'
        ];
    }
    public function uniqueIds(): array
    {
        return ['moid'];
    }
    public function storeData($json){
        $this->data = json_encode($json);
    }
    private function getData(){
        return json_decode($this->data);
    }
    public function getSolicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud');
    }
    public static function createModelo($modelo){
        $model = new Modelos();
        $model->nombre = $modelo['nombre'];
        $model->descripcion = $modelo['descripcion'];
        $model->solicitud = $modelo['solicitud'];
        $model->storeData($modelo['data']);
        $model->save();
        return $model;
    }
    public function updateModelo($modelo){
        $this->nombre = $modelo['nombre'];
        $this->descripcion = $modelo['descripcion'];
        $this->storeData($modelo['data']);
        $this->save();
    }
    protected static function getResourceClass()
    {
        return Resource::class;
    }
}
