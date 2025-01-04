<?php

namespace App\Policies;

use App\Models\Siga\Consumidor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConsumidorPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     *
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el usuario puede ver cualquier modelo, falso en caso contrario.
     *
     * Casos en los que se aprueba:
     * - Si el rol del usuario es 'admin'.
     * - Si el filtro 'propietario' no está vacío y el ID del usuario coincide con el ID del propietario en el filtro.
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
     * @param User $user El usuario que intenta acceder al modelo.
     * @param Consumidor $consumidor El modelo que se intenta acceder.
     * @return bool Retorna true si el usuario puede ver el modelo, de lo contrario false.
     *
     * Casos en los que se aprueba:
     * - Si el usuario tiene el rol de 'admin'.
     * - Si el ID del usuario coincide con el ID del propietario del consumidor.
     */
    public function view(User $user, Consumidor $consumidor): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $consumidor->propietario;
    }

    /**
     * Determina si el usuario puede crear modelos.
     *
     * @param User $user El usuario que realiza la solicitud.
     * @return bool Retorna true si el rol del usuario es 'admin', de lo contrario retorna false.
     *
     * Casos en los que se aprueba:
     * - El usuario tiene el rol de 'admin'.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     *
     * @param User $user El usuario que intenta realizar la acción.
     * @param Consumidor $consumidor El modelo que se intenta actualizar.
     * @return bool Retorna verdadero si el rol del usuario es 'admin', de lo contrario retorna falso.
     *
     * Casos en los que se aprueba:
     * - El usuario tiene el rol de 'admin'.
     */
    public function update(User $user, Consumidor $consumidor): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     *
     * @param User $user El usuario que realiza la acción.
     * @param Consumidor $consumidor El modelo de consumidor que se intenta eliminar.
     * @return bool Retorna true si el usuario tiene el rol de 'admin', de lo contrario retorna false.
     *
     * Casos en los que se aprueba:
     * - El usuario tiene el rol de 'admin'.
     */
    public function delete(User $user, Consumidor $consumidor): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Consumidor $consumidor): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Consumidor $consumidor): bool
    {
        return false;
    }
}
