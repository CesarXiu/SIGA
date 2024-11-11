<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Compartido;
use App\Http\Requests\Siga\CompartidoRequest as Request;

class CompartidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $compartido = Compartido::create($data);
        return response()->json([
            "compartido" => $compartido
        ]);
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
