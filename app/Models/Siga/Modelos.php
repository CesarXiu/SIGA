<?php

namespace App\Models\Siga;
use App\Models\BaseModel as Model;

class Modelos extends Model
{
    protected $table = 'modelos';
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
    public function getData(){
        return json_decode($this->data);
    }
    public function getSolicitud()
    {
        return $this->belongsTo(Solicitud::class, 'solicitud');
    }
}
