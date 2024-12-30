<?php

namespace App\Policies;

use App\Models\Siga\Compartido;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompartidoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        if(!empty(request('filter')['usuario'])){
            return $user->id === (int) request('filter')['usuario'];
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Compartido $compartido): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $compartido->usuario;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        /*if($user->rol === 'admin'){
            return true;
        }*/
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Compartido $compartido): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return true;//$user->id === $compartido->usuario;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Compartido $compartido): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Compartido $compartido): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Compartido $compartido): bool
    {
        return false;
    }
}
