<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Consumidor;
use App\Http\Requests\Siga\ConsumidorRequest as Request;
use App\Http\Controllers\ClientController;
use App\Models\Siga\Solicitud;

class ConsumidorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Client::all();
        return response()->json(Consumidor::resourceCollection(Consumidor::Included()->get()));
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
            if($data['solicitud']){
                $solicitud = Solicitud::findOrFail($data['solicitud']);
                $solicitud->consumidor = $consumidor->coid;
                $solicitud->resuelto = true;
                $solicitud->save();
            }
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
    public function show($id)
    {
        $consumidor = Consumidor::findOrFail($id);
        return response()->json($consumidor->resource());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $consumidor = Consumidor::findOrFail($id);
        $consumidor->update($data);
        return response()->json($consumidor->resource());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $consumidor = Consumidor::findOrFail($id);
        $consumidor->delete();
        ClientController::deleteClient($consumidor['appid']);
        return response()->json($consumidor->resource());
    }
}
