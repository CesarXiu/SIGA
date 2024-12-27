<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Permiso;
use App\Http\Requests\Siga\PermisoRequest as Request;
use App\Http\Requests\PermisoBulkRequest;
/**
 * @OA\Tag(
 *     name="Permisos",
 *     description="Información sobre las relaciones entre Scopes y Roles (Permisos)."
 * )
 */
class PermisoController extends Controller
{
    /**
    * Obten la relacion de los scopes y roles.
    * @OA\Get(
    *     path="/api/permisos",
    *     summary="Obtienes la informacion de los permisos.",
    *     security={{"apiAuth":{}}},
    *     tags={"Permisos"},
    *     @OA\Response(
    *         response="200",
    *         description="OK",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             @OA\Schema(
    *                 type="object",
    *                 @OA\Property(
    *                     property="data",
    *                     type="array",
    *                     @OA\Items(
    *                         type="object",
    *                         @OA\Property(
    *                             property="id",
    *                             type="string",
    *                             example="9dadc62c-e212-49bc-8333-46a33e36544b"
    *                         ),
    *                         @OA\Property(
    *                             property="type",
    *                             type="string",
    *                             example="permiso"
    *                         ),
    *                         @OA\Property(
    *                             property="attributes",
    *                             type="object",
    *                             @OA\Property(
    *                                 property="activo",
    *                                 type="boolean",
    *                                 example=true
    *                             ),
    *                             @OA\Property(
    *                                 property="vista",
    *                                 type="string",
    *                                 example="basic"
    *                             ),
    *                             @OA\Property(
    *                                 property="rol",
    *                                 type="string",
    *                                 example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
    *                             ),
    *                             @OA\Property(
    *                                 property="scope",
    *                                 type="string",
    *                                 example="9d4b5b4c-f514-46d3-bec0-e91228923304"
    *                             )
    *                         ),
    *                         @OA\Property(
    *                             property="relationships",
    *                             type="array",
    *                             @OA\Items()
    *                         )
    *                     )
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Error interno del servidor"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Recurso no encontrado.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Not found."}
    *         )
    *     )
    * )
    */
    public function index()
    {
        return response()->json(Permiso::resourceCollection(Permiso::all()));
    }

    /**
    * Guarda un nuevo permiso.
    * @OA\Post(
    *     path="/api/permisos",
    *     summary="Guarda un nuevo permiso.",
    *     security={{"apiAuth":{}}},
    *     tags={"Permisos"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 type="object",
    *                 @OA\Property(
    *                     property="activo",
    *                     type="boolean",
    *                     example=true
    *                 ),
    *                 @OA\Property(
    *                     property="vista",
    *                     type="string",
    *                     enum={"basic", "complete"},
    *                     example="basic"
    *                 ),
    *                 @OA\Property(
    *                     property="rol",
    *                     type="string",
    *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                     example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
    *                 ),
    *                 @OA\Property(
    *                     property="scope",
    *                     type="string",
    *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                     example="9d4b5b4c-f514-46d3-bec0-e91228923304"
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response="201",
    *         description="Permiso creado exitosamente.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             @OA\Schema(
    *                 type="object",
    *                 @OA\Property(
    *                     property="data",
    *                     type="object",
    *                     @OA\Property(
    *                         property="id",
    *                         type="string",
    *                         example="9dadc62c-e212-49bc-8333-46a33e36544b"
    *                     ),
    *                     @OA\Property(
    *                         property="type",
    *                         type="string",
    *                         example="permiso"
    *                     ),
    *                     @OA\Property(
    *                         property="attributes",
    *                         type="object",
    *                         @OA\Property(
    *                             property="activo",
    *                             type="boolean",
    *                             example=true
    *                         ),
    *                         @OA\Property(
    *                             property="vista",
    *                             type="string",
    *                             example="basic"
    *                         ),
    *                         @OA\Property(
    *                             property="rol",
    *                             type="string",
    *                             example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
    *                         ),
    *                         @OA\Property(
    *                             property="scope",
    *                             type="string",
    *                             example="9d4b5b4c-f514-46d3-bec0-e91228923304"
    *                         )
    *                     )
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Error interno del servidor"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Recurso no encontrado.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Not found."}
    *         )
    *     )
    * )
    */
    public function store(Request $request)
    {
        $data = $request->validated();
        return Permiso::create($data);
    }
    /**
    * Guarda una lista de nuevos scopes para un rol.
    * @OA\Post(
    *     path="/api/permisos/scopes",
    *     summary="Insercion de nuevos scopes para un rol.",
    *     security={{"apiAuth":{}}},
    *     tags={"Permisos"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 type="object",
    *                 @OA\Property(
    *                     property="activo",
    *                     type="boolean",
    *                     example=true
    *                 ),
    *                 @OA\Property(
    *                     property="vista",
    *                     type="string",
    *                     enum={"basic", "complete"},
    *                     example="basic"
    *                 ),
    *                 @OA\Property(
    *                     property="rol",
    *                     type="string",
    *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                     example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
    *                 ),
    *                 @OA\Property(
    *                     property="scope",
    *                     type="array",
    *                     @OA\Items(
    *                         type="string",
    *                         pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                         example="9d4b5b4c-f514-46d3-bec0-e91228923304"
    *                     )
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Scopes agregados.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"message": "Scopes agregados"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Error interno del servidor"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Recurso no encontrado.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Not found."}
    *         )
    *     )
    * )
    */
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
    /**
    * Elimina una lista de scopes para un rol.
    * @OA\Delete(
    *     path="/api/permisos/scopes",
    *     summary="Eliminacion de scopes en un rol.",
    *     security={{"apiAuth":{}}},
    *     tags={"Permisos"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 type="object",
    *                 @OA\Property(
    *                     property="activo",
    *                     type="boolean",
    *                     example=true
    *                 ),
    *                 @OA\Property(
    *                     property="vista",
    *                     type="string",
    *                     enum={"basic", "complete"},
    *                     example="basic"
    *                 ),
    *                 @OA\Property(
    *                     property="rol",
    *                     type="string",
    *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                     example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
    *                 ),
    *                 @OA\Property(
    *                     property="scope",
    *                     type="array",
    *                     @OA\Items(
    *                         type="string",
    *                         pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$",
    *                         example="9d4b5b4c-f514-46d3-bec0-e91228923304"
    *                     )
    *                 )
    *             )
    *         )
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Scopes eliminados.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"message": "Scopes eliminados"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="500",
    *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Error interno del servidor"}
    *         )
    *     ),
    *     @OA\Response(
    *         response="404",
    *         description="Recurso no encontrado.",
    *         @OA\MediaType(
    *             mediaType="application/vnd.api+json",
    *             example={"error": "Not found."}
    *         )
    *     )
    * )
    */
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
