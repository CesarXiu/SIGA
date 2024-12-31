<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Compartido;
use App\Http\Requests\Siga\CompartidoRequest as Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class CompartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Compartido::class);
        $compartidos = Compartido::Included()->Filtered()->get();
        return response()->json(
            Compartido::resourceCollection($compartidos)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        Gate::authorize('create',[Compartido::class, $data]); //La validacion se hace desde el request
        $usuario = User::where('email', $data['usuario'])->first();
        $data['usuario'] = $usuario->id;
        $compartido = Compartido::create($data);
        return response()->json($compartido->resource());
    }

    /**
     * Display the specified resource.
     */
    public function show(Compartido $compartido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compartido $compartido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compartido $compartido)
    {
        //
    }
}
