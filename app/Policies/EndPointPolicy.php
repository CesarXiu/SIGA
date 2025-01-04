<?php

namespace App\Policies;

use App\Models\Siga\EndPoint;
use App\Models\User;
use Illuminate\Auth\Access\Response;


/**
 * Clase EndPointPolicy
 * 
 * Esta clase define las políticas de acceso para el modelo EndPoint.
 */
class EndPointPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario false.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param EndPoint $endPoint El modelo EndPoint que se desea ver.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario false.
     */
    public function view(User $user, EndPoint $endPoint): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario false.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param EndPoint $endPoint El modelo EndPoint que se desea actualizar.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario false.
     */
    public function update(User $user, EndPoint $endPoint): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param EndPoint $endPoint El modelo EndPoint que se desea eliminar.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario false.
     */
    public function delete(User $user, EndPoint $endPoint): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param EndPoint $endPoint El modelo EndPoint que se desea restaurar.
     * @return bool Retorna false ya que no se permite restaurar el modelo.
     */
    public function restore(User $user, EndPoint $endPoint): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param EndPoint $endPoint El modelo EndPoint que se desea eliminar permanentemente.
     * @return bool Retorna false ya que no se permite eliminar permanentemente el modelo.
     */
    public function forceDelete(User $user, EndPoint $endPoint): bool
    {
        return false;
    }
}
