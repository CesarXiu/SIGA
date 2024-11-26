<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Solicitud;
use App\Http\Requests\Siga\SolicitudRequest as Request;
use App\Models\Siga\Modelos;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Solicitud::resourceCollection(Solicitud::all())
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        //dd($data);
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
    public function show(Solicitud $solicitud)
    {
        //$solicitud = Solicitud::find("9d93c2ee-c35f-483e-a344-12638fb01d40");
        dd($solicitud);
        //$solicitud->getModelos;
        return response()->json(
            $solicitud->resource()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
