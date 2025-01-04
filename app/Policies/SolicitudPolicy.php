<?php

namespace App\Policies;

use App\Models\Siga\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el usuario es administrador o si el filtro de propietario coincide con el ID del usuario, falso en caso contrario.
     */
    public function viewAny(User $user): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        if(!empty(request('filter')['propietario'])){
            return $user->id === (int) request('filter')['propietario'];
        }
        return false;
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Solicitud $solicitud La solicitud que se quiere ver.
     * @return bool Verdadero si el usuario es administrador o si el usuario es el propietario de la solicitud, falso en caso contrario.
     */
    public function view(User $user, Solicitud $solicitud): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $solicitud->propietario;
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Siempre verdadero.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Solicitud $solicitud La solicitud que se quiere actualizar.
     * @return bool Verdadero si el usuario es administrador o si el usuario es el propietario de la solicitud, falso en caso contrario.
     */
    public function update(User $user, Solicitud $solicitud): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $solicitud->propietario;
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Solicitud $solicitud La solicitud que se quiere eliminar.
     * @return bool Verdadero si el usuario es administrador, falso en caso contrario.
     */
    public function delete(User $user, Solicitud $solicitud): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Solicitud $solicitud La solicitud que se quiere restaurar.
     * @return bool Siempre falso.
     */
    public function restore(User $user, Solicitud $solicitud): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Solicitud $solicitud La solicitud que se quiere eliminar permanentemente.
     * @return bool Siempre falso.
     */
    public function forceDelete(User $user, Solicitud $solicitud): bool
    {
        return false;
    }
}
