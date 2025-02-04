<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool{
        return $user->rol === 'admin';
    }

    public function view(User $user, User $usuario): bool
    {
        return $user->rol === 'admin'|| $user->id === $usuario->id;
    }

    public function create(User $user): bool
    {
        return $user->rol === 'admin';
    }

    public function update(User $user, User $usuario): bool
    {
        return $user->rol === 'admin';
    }

    public function delete(User $user, User $usuario): bool
    {
        return $user->rol === 'admin';
    }
}
