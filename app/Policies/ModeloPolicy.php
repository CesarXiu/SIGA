<?php

namespace App\Policies;

use App\Models\Siga\Modelos;
use App\Models\Siga\Solicitud;
use App\Models\User;

class ModeloPolicy
{
    /**
     * Determine whether the user can view any models.
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
     * Determine whether the user can view the model.
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
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
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
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Modelos $modelo): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Modelos $modelo): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Modelos $modelo): bool
    {
        return false;
    }
}
