<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Scope;
use App\Http\Requests\Siga\ScopeRequest as Request;
/**
 * @OA\Tag(
 *     name="Scopes",
 *     description="Información sobre los alcances, nombre y estatus de los mismos."
 * )
 */
class ScopeController extends Controller
{
/**
 * Obten la informacion de todos los SCOPE.
 * @OA\Get(
 *     path="/api/scopes",
 *     summary="Obtienes la informacion de los Scopes.",
 *     security={{"apiAuth":{}}},
 *     tags={"Scopes"},
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
 *                @OA\Items(
 *                     @OA\Property(
 *                         property="id",
 *                         type="string",
 *                         example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="scope"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="activo",
 *                             type="boolean",
 *                             example=false
 *                         ),
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre.read"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *       )
 *     ),
 *@OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     ),
 *@OA\Response(
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
        return response()->json(
            Scope::resourceCollection(Scope::all())
            , 200);
    }

/**
 * Crea un nuevo SCOPE.
 * @OA\Post(
 *     path="/api/scopes",
 *     summary="Crear un nuevo scope.",
 *     security={{"apiAuth":{}}},
 *     tags={"Scopes"},
 *     @OA\RequestBody(
 *     @OA\MediaType(
 *         mediaType="application/vnd.api+json",
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example="true"
 *             ),
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="alumno.read"
 *             )
 *         )
 *     )
 * ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
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
 *                         example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="scope"
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
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre.read"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *@OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     ),
 *@OA\Response(
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
        return response()->json(
            (Scope::create($data))->resource()
        , 201);
    }

/**
 * Obten la informacion de un SCOPE.
 * @OA\Get(
 *     path="/api/scopes/{id}",
 *     summary="Obtienes la informacion de un scope.",
 *     security={{"apiAuth":{}}},
 *     tags={"Scopes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="UUID del Scope",
 *         @OA\Schema(
 *             type="string",
 *             example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
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
 *                         example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="scope"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="activo",
 *                             type="boolean",
 *                             example=false
 *                         ),
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre.read"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *@OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     ),
 *@OA\Response(
 *         response="404",
 *         description="Recurso no encontrado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Not found."}
 *         )
 *     )
 * )
 */
    public function show(Scope $scope)
    {
        dd($scope);
        return response()->json( 
            $scope->resource()
        , 200);
    }

/**
 * Actualizar informacion de un SCOPE.
 * @OA\Put(
 *     path="/api/scopes/{id}",
 *     summary="Actualiza la informacion de una scope.",
 *     security={{"apiAuth":{}}},
 *     tags={"Scopes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="UUID del Scope",
 *         @OA\Schema(
 *             type="string",
 *             example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *         )
 *     ),
 *     @OA\RequestBody(
 *     @OA\MediaType(
 *         mediaType="application/vnd.api+json",
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example="false"
 *             ),
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="alumno.read"
 *             )
 *         )
 *     )
 * ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
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
 *                         example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="scope"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="activo",
 *                             type="boolean",
 *                             example=false
 *                         ),
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre.read"
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *@OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     ),
 *@OA\Response(
 *         response="404",
 *         description="Recurso no encontrado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Not found."}
 *         )
 *     )
 * )
 */
    public function update(Request $request, Scope $scope)
    {
        $data = $request->validated();
        $scope->update($data);
        return response()->json(
            $scope->resource()
        , 200);
    }

/**
 * Elimina un SCOPE.
 * @OA\Delete(
 *     path="/api/scopes/{id}",
 *     summary="Elimina un scope y sus relaciones.",
 *     security={{"apiAuth":{}}},
 *     tags={"Scopes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="UUID del Scope",
 *         @OA\Schema(
 *             type="string",
 *             example="9d78f245-f961-4b5a-95cb-86b20e5602af"
 *         )
 *     ),
 * @OA\Response(
 *   response="204",
 *   description="No Content",
 *   @OA\MediaType(
 *       mediaType="application/vnd.api+json",
 *       example=null
 *   )
 *),
 *@OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     ),
 *@OA\Response(
 *         response="404",
 *         description="Recurso no encontrado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Not found."}
 *         )
 *     )
 * )
 */
    public function destroy(Scope $scope)
    {
        $scope->delete();
        return response()->json(null, 204);
    }
}
