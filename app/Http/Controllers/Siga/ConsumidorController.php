<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Consumidor;
use App\Http\Requests\Siga\ConsumidorRequest as Request;

class ConsumidorController extends Controller
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
        return Consumidor::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumidor $consumidor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumidor $consumidor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumidor $consumidor)
    {
        //
    }
}
