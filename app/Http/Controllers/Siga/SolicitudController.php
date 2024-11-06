<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Solicitud;
use App\Http\Requests\Siga\SolicitudRequest as Request;

class SolicitudController extends Controller
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
        dd($data);
        return Solicitud::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Solicitud $solicitud)
    {
        //
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
