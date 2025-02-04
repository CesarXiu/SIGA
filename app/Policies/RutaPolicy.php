<?php

namespace App\Policies;

use App\Models\Siga\Ruta;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RutaPolicy
{
    /**
     * Determina si el usuario puede ver cualquier modelo.
     * 
     * @param User $user
     * @return bool
     * 
     * Aprobado: Siempre retorna true, cualquier usuario puede ver cualquier modelo.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user
     * @param Ruta $ruta
     * @return bool
     * 
     * Aprobado: Siempre retorna true, cualquier usuario puede ver el modelo.
     */
    public function view(User $user, Ruta $ruta): bool
    {
        \Log::info('Politica');
        return true;
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user
     * @return bool
     * 
     * Aprobado: Retorna true solo si el rol del usuario es 'admin'.
     */
    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * @param User $user
     * @param Ruta $ruta
     * @return bool
     * 
     * Aprobado: Retorna true solo si el rol del usuario es 'admin'.
     */
    public function update(User $user, Ruta $ruta): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * @param User $user
     * @param Ruta $ruta
     * @return bool
     * 
     * Aprobado: Retorna true solo si el rol del usuario es 'admin'.
     */
    public function delete(User $user, Ruta $ruta): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user
     * @param Ruta $ruta
     * @return bool
     * 
     * Aprobado: Siempre retorna false, ningún usuario puede restaurar el modelo.
     */
    public function restore(User $user, Ruta $ruta): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user
     * @param Ruta $ruta
     * @return bool
     * 
     * Aprobado: Siempre retorna false, ningún usuario puede eliminar permanentemente el modelo.
     */
    public function forceDelete(User $user, Ruta $ruta): bool
    {
        return false;
    }
}
