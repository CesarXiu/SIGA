<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\EndPoint;
use App\Http\Requests\Siga\EndPointRequest as Request;
use Illuminate\Support\Facades\Gate;
/**
 * @OA\Tag(
 *     name="EndPoints",
 *     description="Información sobre los EndPoints disponibles."
 * )
 */
class EndPointController extends Controller
{
/**
 * Obten la informacion de todos los EndPoints.
 * @OA\Get(
 *     path="/api/endpoints",
 *     summary="Obtienes la informacion de los EndPoints.",
 *     security={{"apiAuth":{}}},
 *     tags={"EndPoints"},
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
 *                         example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="endPoint"
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
 *                             example="Docentes"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informacion de los docentes"
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
        Gate::authorize('viewAny', EndPoint::class);
        return response()->json(EndPoint::resourceCollection(EndPoint::Included()->get()));
    }
/**
 * Crea un nuevo EndPoint.
 * @OA\Post(
 *     path="/api/endpoints",
 *     summary="Crea un nuevo EndPoint.",
 *     security={{"apiAuth":{}}},
 *     tags={"EndPoints"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="nombre",
 *                     type="string",
 *                     example="Docentes"
 *                 ),
 *                 @OA\Property(
 *                     property="descripcion",
 *                     type="string",
 *                     example="Informacion de los docentes"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Created",
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
 *                         example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="endPoint"
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
 *                             example="Docentes"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informacion de los docentes"
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
        Gate::authorize('create', EndPoint::class);
        $endpoint = EndPoint::create($data);
        return response()->json($endpoint->resource());
    }
/**
 * Obten la informacion de un EndPoint.
 * @OA\Get(
 *     path="/api/endpoints/{id}",
 *     summary="Obtienes la informacion de un EndPoint.",
 *     security={{"apiAuth":{}}},
 *     tags={"EndPoints"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *         ),
 *         description="ID del EndPoint"
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
 *                         example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="endPoint"
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
 *                             example="Docentes"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informacion de los docentes"
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
    public function show($id)
    {
        $endPoint = EndPoint::findOrFail($id);
        Gate::authorize('view', $endPoint);
        return response()->json($endPoint->resource());
    }

/**
 * Actualiza un EndPoint existente.
 * @OA\Put(
 *     path="/api/endpoints/{id}",
 *     summary="Actualiza un EndPoint existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"EndPoints"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *         ),
 *         description="ID del EndPoint"
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="nombre",
 *                     type="string",
 *                     example="Docentes"
 *                 ),
 *                 @OA\Property(
 *                     property="descripcion",
 *                     type="string",
 *                     example="Informacion de los docentes"
 *                 )
 *             )
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
 *                         example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="endPoint"
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
 *                             example="Docentes"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informacion de los docentes"
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
public function update(Request $request, $id)
{
    $data = $request->validated();
    $endPoint = EndPoint::findOrFail($id);
    Gate::authorize('view', $endPoint);
    $endPoint->update($data);
    return response()->json($endPoint->resource());
}

/**
 * Elimina un EndPoint.
 * @OA\Delete(
 *     path="/api/endpoints/{id}",
 *     summary="Elimina un EndPoint.",
 *     security={{"apiAuth":{}}},
 *     tags={"EndPoints"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9da7dcef-e7d5-4147-9b23-db00a55f7846"
 *         ),
 *         description="ID del EndPoint"
 *     ),
 *     @OA\Response(
 *         response="204",
 *         description="No Content"
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
    public function destroy($id)
    {
        $endPoint = EndPoint::findOrFail($id);
        Gate::authorize('view', $endPoint);
        $endPoint->delete();
        return response()->json(null, 204);
    }
}
