<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Modelos;
use App\Http\Requests\Siga\ModeloRequest as Request;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelos::all();
        return response()->json(Modelos::resourceCollection($modelos));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $modelo = Modelos::createModelo($data);
        return response()->json($modelo->resource());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $modelo = Modelos::find($id);
        return response()->json(
            $modelo->resource()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modelos $modelos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modelos $modelos)
    {
        //
    }
}
