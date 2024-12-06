<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Ruta;
use App\Http\Requests\Siga\RutaRequest as Request;

class RutaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Ruta::resourceCollection(Ruta::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $ruta = Ruta::create($data);
        return response()->json($ruta->resource());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ruta = Ruta::findOrFail($id);
        return response()->json($ruta->resource());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $ruta = Ruta::findOrFail($id);
        $ruta->update($data);
        return response()->json($ruta->resource());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruta $ruta)
    {
        $ruta->delete();
        return response()->json(null, 204);
    }
}
