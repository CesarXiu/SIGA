<?php
namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
/*
    TODOS ESTOS TRAITS SON PARA UTILIZARLOS EN LOS CONTROLADORES DE API
    SON CARGADOS DESDE EL MODELO BASE Y SON HEREDADOS A TODOS LOS DEMAS MODELOS QUE HEREDEN DE ESTE
*/
trait ApiTraits{
    /*
        Scope para incluir relaciones desde una consulta HTTP, utilizando query params y relaciones en el modelo.
        Ejemplo de uso:
            - Se envia una peticion GET a la url /api/solicitudes?included=modelos
            - Se incluiran los modelos en la consulta.
        Requisitos:
            - Declarar un array $allowIncluded en el modelo.
            - Declarar las relaciones en el modelo con prefijo get, seguido del nombre de la relacion.
            - Al realizar la consulta incluir ->Included()->get()
            - En la url se debe enviar un parametro included con las relaciones a incluir separadas por comas.
        Return:
            - Relaciones incluidas en la consulta, bajo el nombre de la relacion.
    */
    public function scopeIncluded(Builder $query){
        //Se revisa si existe el arreglo allowIncluded en el modelo y si se envio el parametro included en la url.
        if(empty($this->allowIncluded) || empty(request('included'))){
            return;
        }
        //Se obtienen las relaciones a incluir, deben de estar separadas por comas.
        $relations = explode(',', request('included'));
        //Se hace un arreglo con las relaciones que desea cargar.
        //Se filtran las relaciones que no estan permitidas.
        $allowIncluded = collect($this->allowIncluded);
        //dd($allowIncluded);
        foreach ($relations as $key => $relation) {
            if(!$allowIncluded->contains($relation)){
                \Log::info("Se elimina la relacion: ".$relation." que no esta permitida.");
                //Se elimina la relacion que no esta permitida.
                unset($relations[$key]);
            }
        }
        $relations = array_map(function($relation) {
            $relation = 'get'.$relation;
            return $relation;
        }, $relations);
        //Se cargan las relaciones en la consulta.
        $query->with($relations);
    }

    public function scopeFiltered(Builder $query){
        if(empty($this->allowFilter) || empty(request('filter'))){
            return;
        }
        $allowFilter = collect($this->allowFilter);
        $filters = request('filter');
        foreach ($filters as $filter => $value) {
            if($allowFilter->contains($filter)){
                $query->where($filter, $value);
            }
        }
    }
}