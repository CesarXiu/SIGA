<?php

namespace App\Policies;

use App\Models\Siga\Solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudPolicy
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
    public function view(User $user, Solicitud $solicitud): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $solicitud->propietario;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Solicitud $solicitud): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        return $user->id === $solicitud->propietario;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Solicitud $solicitud): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Solicitud $solicitud): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Solicitud $solicitud): bool
    {
        return false;
    }
}
