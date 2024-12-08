<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Consumidor;
use App\Http\Requests\Siga\ConsumidorRequest as Request;
use App\Http\Controllers\ClientController;

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
        $newClient = ClientController::newClient($data['propietario'], $data['nombre']);
        $data['appid'] = $newClient['client_id'];
        try {
            $consumidor = Consumidor::create($data);
            return response()->json([
            "data" => [
                "consumidor" => $consumidor->resource()['data'],
                "client_id" => $newClient['client_id'],
                "client_secret" => $newClient['client_secret']
            ]
            ]);
        } catch (\Exception $e) {
            ClientController::deleteClient($newClient['client_id']);
            return response()->json(['error' => 'Failed to create consumidor', 'message' => $e->getMessage(), "data" => $data], 500);
        }
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
