<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest as Request;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', User::class);
        $users = User::all();
        return response()->json(User::resourceCollection($users), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', User::class);
        $data = $request->validated();
        $user = User::create($data);
        return response()->json($user->resource(), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        Gate::authorize('show', User::class);
        return response()->json($user->resource(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('update', $user);
        $data = $request->validated();
        $data['password'] = $data['password'] ?? $user->password;
        $user->update($data);
        return response()->json($user->resource(), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Gate::authorize('delete', $user);
        $user->delete();
        return response()->json(null, 204);
    }
}
