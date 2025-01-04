<?php

namespace App\Policies;

use App\Models\Siga\Modelos;
use App\Models\Siga\Solicitud;
use App\Models\User;

class ModeloPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user El usuario actual.
     * @return bool Verdadero si el usuario es administrador o si el usuario es propietario de la solicitud filtrada.
     */
    public function viewAny(User $user): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        if(!empty(request('filter')['solicitud'])){
            $solicitud = Solicitud::findOrFail(request('filter')['solicitud']);
            return $user->id === $solicitud->propietario;
        }
        return false;
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario actual.
     * @param Modelos $modelo El modelo a visualizar.
     * @return bool Verdadero si el usuario es administrador o si el usuario es propietario de la solicitud asociada al modelo.
     */
    public function view(User $user, Modelos $modelo): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        $solicitud = $modelo->getSolicitud;
        return $solicitud->propietario === $user->id;
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario actual.
     * @return bool Siempre verdadero.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user El usuario actual.
     * @param Modelos $modelo El modelo a actualizar.
     * @return bool Verdadero si el usuario es administrador o si el usuario es propietario de la solicitud asociada al modelo.
     */
    public function update(User $user, Modelos $modelo): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        $solicitud = $modelo->getSolicitud;
        return $solicitud->propietario === $user->id;
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user El usuario actual.
     * @param Modelos $modelo El modelo a eliminar.
     * @return bool Verdadero solo si el usuario es administrador.
     */
    public function delete(User $user, Modelos $modelo): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario actual.
     * @param Modelos $modelo El modelo a restaurar.
     * @return bool Siempre falso.
     */
    public function restore(User $user, Modelos $modelo): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario actual.
     * @param Modelos $modelo El modelo a eliminar permanentemente.
     * @return bool Siempre falso.
     */
    public function forceDelete(User $user, Modelos $modelo): bool
    {
        return false;
    }
}
