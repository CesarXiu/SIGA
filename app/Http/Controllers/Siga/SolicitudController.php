<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Solicitud;
use App\Http\Requests\Siga\SolicitudRequest as Request;
use App\Http\Requests\Siga\SolicitudUpdateRequest as UpdateRequest;
use App\Models\Siga\Modelos;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Solicitud::resourceCollection(Solicitud::Included()->get())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        $solicitud = Solicitud::create($data);
        $modelos = $data['archivos'];
        foreach($modelos as $modelo){
            $model = new Modelos();
            $model->nombre = $modelo['nombre'];
            $model->descripcion = $modelo['descripcion'];
            $model->solicitud = $solicitud->soid;
            $model->storeData($modelo['data']);
            $model->save();
        }
        $solicitud->getModelos;
        return response()->json(
            $solicitud->resource()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $solicitud = Solicitud::Included()->findOrFail($id);
        return response()->json(
            $solicitud->resource()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        //dd($id);
        $data = $request->validated();
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($data);
        return response()->json(
            $solicitud->resource()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
