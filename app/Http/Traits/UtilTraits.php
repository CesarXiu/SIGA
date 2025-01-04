<?php
namespace App\Http\Traits;

/**
 * Trait UtilTraits
 *
 * Este trait proporciona métodos para manejar colecciones de recursos y recursos individuales.
 * 
 * Métodos:
 * - resourceCollection($data): Devuelve una colección de recursos en un formato específico.
 * - resource(): Devuelve un recurso individual en un formato específico.
 * 
 * Métodos abstractos:
 * - getResourceClass(): Debe ser implementado por la clase que use este trait para devolver la clase del recurso.
 */
trait UtilTraits
{
    /**
     * Devuelve una colección de recursos en un formato específico.
     *
     * @param mixed $data Los datos que se convertirán en una colección de recursos.
     * @return array Un array con la colección de recursos.
     */
    public static function resourceCollection($data)
    {
        return ["data" => static::getResourceClass()::collection($data)];
    }

    /**
     * Devuelve un recurso individual en un formato específico.
     *
     * @return array Un array con el recurso individual.
     */
    public function resource()
    {
        return ["data" => static::getResourceClass()::make($this)];
    }

    /**
     * Debe ser implementado por la clase que use este trait para devolver la clase del recurso.
     *
     * @return string El nombre de la clase del recurso.
     */
    abstract protected static function getResourceClass();
}