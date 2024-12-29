<?php

namespace App\Policies;

use App\Models\Siga\Ruta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RutaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ruta $ruta): bool
    {
        return true;
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
    public function update(User $user, Ruta $ruta): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ruta $ruta): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ruta $ruta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ruta $ruta): bool
    {
        return false;
    }
}
