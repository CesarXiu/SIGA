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
    /**
     * Método para obtener una colección de recursos de EndPoint.
     *
     * Este método autoriza al usuario para ver cualquier instancia de EndPoint
     * utilizando la política de autorización 'viewAny'. Luego, retorna una
     * respuesta JSON con una colección de recursos de EndPoint, incluyendo
     * las relaciones especificadas en el método 'Included'.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con la colección de recursos de EndPoint.
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
    /**
     * Almacena un nuevo recurso EndPoint.
     *
     * Este método valida la solicitud entrante, autoriza la creación de un nuevo
     * recurso EndPoint y lo almacena en la base de datos. Luego, devuelve una
     * respuesta JSON con el recurso creado.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP entrante.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con el recurso creado.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para crear el recurso.
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
    /**
     * Muestra el recurso EndPoint especificado.
     *
     * @param  int  $id  El ID del recurso EndPoint a mostrar.
     * @return \Illuminate\Http\JsonResponse  La respuesta JSON con el recurso EndPoint.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  Si no se encuentra el recurso EndPoint.
     * @throws \Illuminate\Auth\Access\AuthorizationException  Si el usuario no está autorizado para ver el recurso EndPoint.
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
/**
 * Actualiza un recurso EndPoint existente.
 *
 * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados.
 * @param int $id El identificador del recurso EndPoint a actualizar.
 * @return \Illuminate\Http\JsonResponse La respuesta JSON que contiene el recurso EndPoint actualizado.
 *
 * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para ver el recurso EndPoint.
 * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el recurso EndPoint con el ID proporcionado.
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
    /**
     * Elimina un recurso EndPoint especificado por su ID.
     *
     * @param  int  $id  El ID del recurso EndPoint a eliminar.
     * @return \Illuminate\Http\JsonResponse  Respuesta JSON con estado 204 (No Content) si la eliminación fue exitosa.
     * @throws \Illuminate\Auth\Access\AuthorizationException  Si el usuario no está autorizado para eliminar el recurso.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  Si no se encuentra el recurso EndPoint con el ID especificado.
     */
    public function destroy($id)
    {
        $endPoint = EndPoint::findOrFail($id);
        Gate::authorize('view', $endPoint);
        $endPoint->delete();
        return response()->json(null, 204);
    }
}
