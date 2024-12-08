<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Permiso;
use App\Http\Requests\Siga\PermisoRequest as Request;
use App\Http\Requests\PermisoBulkRequest;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Permiso::resourceCollection(Permiso::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        return Permiso::create($data);
    }
    public function storeScopes(PermisoBulkRequest $request)
    {
        $data = $request->validated();
        foreach($data['scope'] as $scope){
            Permiso::create([
                'scope' => $scope,
                'rol' => $data['rol']
            ]);
        }
        return response()->json(['message' => 'Scopes agregados'], 201);
    }
    public function deleteScopes(PermisoBulkRequest $request)
    {
        $data = $request->validated();
        foreach($data['scope'] as $scope){
            Permiso::where('rol', $data['rol'])
                    ->whereIn('scope', $data['scope'])
                    ->delete();
        }
        return response()->json(['message' => 'Scopes eliminados'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
