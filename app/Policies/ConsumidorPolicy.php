<?php

namespace App\Policies;

use App\Models\Siga\Consumidor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ConsumidorPolicy
{
    /**
     * Determine whether the user can view any models.
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
     * Determine whether the user can view the model.
     */
    public function view(User $user, Consumidor $consumidor): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $consumidor->propietario;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Consumidor $consumidor): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
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
