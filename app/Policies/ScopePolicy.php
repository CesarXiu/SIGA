<?php

namespace App\Policies;

use App\Models\Siga\Scope;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ScopePolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el rol del usuario es 'admin', falso en caso contrario.
     */
    public function viewAny(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Scope $scope El modelo que se desea ver.
     * @return bool Verdadero si el rol del usuario es 'admin', falso en caso contrario.
     */
    public function view(User $user, Scope $scope): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el rol del usuario es 'admin', falso en caso contrario.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Scope $scope El modelo que se desea actualizar.
     * @return bool Verdadero si el rol del usuario es 'admin', falso en caso contrario.
     */
    public function update(User $user, Scope $scope): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Scope $scope El modelo que se desea eliminar.
     * @return bool Verdadero si el rol del usuario es 'admin', falso en caso contrario.
     */
    public function delete(User $user, Scope $scope): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Scope $scope El modelo que se desea restaurar.
     * @return bool Siempre retorna falso, ya que no se permite restaurar el modelo.
     */
    public function restore(User $user, Scope $scope): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Scope $scope El modelo que se desea eliminar permanentemente.
     * @return bool Siempre retorna falso, ya que no se permite eliminar permanentemente el modelo.
     */
    public function forceDelete(User $user, Scope $scope): bool
    {
        return false;
    }
}
