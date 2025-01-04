<?php
namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Filtra la consulta basada en los filtros permitidos y los valores proporcionados en la solicitud.
     *
     * @param Builder $query La consulta de Eloquent Builder que se va a filtrar.
     * @return void
     *
     * La función verifica si hay filtros permitidos definidos en la propiedad $allowFilter del modelo
     * y si hay filtros proporcionados en la solicitud. Si alguno de estos está vacío, la función retorna sin hacer nada.
     *
     * Luego, convierte la propiedad $allowFilter en una colección y obtiene los filtros de la solicitud.
     * Recorre cada filtro proporcionado en la solicitud y verifica si está en la lista de filtros permitidos.
     * Si el filtro está permitido, agrega una condición "where" a la consulta para ese filtro y su valor correspondiente.
     */
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

    /**
     * Método de alcance para ordenar los resultados de una consulta.
     *
     * Este método permite ordenar los resultados de una consulta basada en los parámetros
     * de ordenamiento proporcionados en la solicitud HTTP. Si no se especifican parámetros
     * de ordenamiento o no se permiten los campos de ordenamiento, no se realiza ninguna acción.
     *
     * @param Builder $query La consulta que se va a ordenar.
     * @return void
     */
    public function scopeSorted(Builder $query){
        // Verifica si no hay campos permitidos para ordenar o si no se especifica el parámetro 'sort' en la solicitud.
        if(empty($this->allowSort) || empty(request('sort'))){
            return;
        }
        // Convierte los campos permitidos para ordenar en una colección.
        $allowSort = collect($this->allowSort);
        // Divide los parámetros de ordenamiento proporcionados en la solicitud en un array.
        $sorts = explode(',', request('sort'));
        // Itera sobre cada parámetro de ordenamiento.
        foreach ($sorts as $sort) {
            $direction = 'asc'; // Dirección predeterminada de ordenamiento.
            // Si el parámetro de ordenamiento comienza con '-', se establece la dirección a 'desc'.
            if(substr($sort, 0, 1) == '-'){
                $direction = 'desc';
                $sort = substr($sort, 1); // Elimina el '-' del nombre del campo.
            }
            // Si el campo de ordenamiento está permitido, se agrega a la consulta con la dirección especificada.
            if($allowSort->contains($sort)){
                $query->orderBy($sort, $direction);
            }
        }
    }
}