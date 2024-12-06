<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\EndPoint;
use App\Http\Requests\Siga\EndPointRequest as Request;

class EndPointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EndPoint::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        return EndPoint::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(EndPoint $endPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EndPoint $endPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EndPoint $endPoint)
    {
        //
    }
}
