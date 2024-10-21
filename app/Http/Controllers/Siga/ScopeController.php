<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Scope;
use Illuminate\Http\Request;

class ScopeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Scope::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        return Scope::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Scope $scope)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Scope $scope)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Scope $scope)
    {
        //
    }
}
