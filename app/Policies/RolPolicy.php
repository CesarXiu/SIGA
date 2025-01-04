<?php

namespace App\Policies;

use App\Models\Siga\Rol;
use App\Models\User;
use Illuminate\Auth\Access\Response;


/**
 * Clase RolPolicy
 * 
 * Esta clase define las políticas de acceso para el modelo Rol.
 * Solo los usuarios con el rol de 'admin' tienen permisos para ver, crear, actualizar y eliminar modelos.
 * No se permite la restauración ni la eliminación permanente de modelos.
 */
class RolPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el usuario tiene el rol de 'admin', falso en caso contrario.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Rol $rol El modelo Rol que se desea ver.
     * @return bool Verdadero si el usuario tiene el rol de 'admin', falso en caso contrario.
     */
    public function view(User $user, Rol $rol): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el usuario tiene el rol de 'admin', falso en caso contrario.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Rol $rol El modelo Rol que se desea actualizar.
     * @return bool Verdadero si el usuario tiene el rol de 'admin', falso en caso contrario.
     */
    public function update(User $user, Rol $rol): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Rol $rol El modelo Rol que se desea eliminar.
     * @return bool Verdadero si el usuario tiene el rol de 'admin', falso en caso contrario.
     */
    public function delete(User $user, Rol $rol): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Rol $rol El modelo Rol que se desea restaurar.
     * @return bool Siempre retorna falso, no se permite la restauración de modelos.
     */
    public function restore(User $user, Rol $rol): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Rol $rol El modelo Rol que se desea eliminar permanentemente.
     * @return bool Siempre retorna falso, no se permite la eliminación permanente de modelos.
     */
    public function forceDelete(User $user, Rol $rol): bool
    {
        return false;
    }
}
