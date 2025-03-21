<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Modelos;
use App\Http\Requests\Siga\ModeloRequest as Request;
use Illuminate\Support\Facades\Gate;
/**
 * @OA\Tag(
 *     name="Modelos",
 *     description="Información sobre los Modelos solicitados."
 * )
 */
class ModeloController extends Controller
{
/**
 * Obten la informacion de todos los Modelos.
 * @OA\Get(
 *     path="/api/modelos",
 *     summary="Obtienes la informacion de los Modelos.",
 *     security={{"apiAuth":{}}},
 *     tags={"Modelos"},
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
 *                             example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="modelo"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="Alumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="descripcion",
 *                                 type="string",
 *                                 example="Informaciondelosalumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="solicitud",
 *                                 type="string",
 *                                 example="9d93c2ee-c35f-483e-a344-12638fb01d40"
 *                             ),
 *                             @OA\Property(
 *                                 property="data",
 *                                 type="array",
 *                                 @OA\Items(
 *                                     type="object",
 *                                     @OA\Property(
 *                                         property="nombre",
 *                                         type="string",
 *                                         example="nombre"
 *                                     ),
 *                                     @OA\Property(
 *                                         property="descripcion",
 *                                         type="string",
 *                                         example="nombredelalumno"
 *                                     ),
 *                                     @OA\Property(
 *                                         property="tipo",
 *                                         type="string",
 *                                         example="string"
 *                                     )
 *                                 )
 *                             )
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
     * Método para obtener y devolver una colección de modelos en formato JSON.
     *
     * Este método autoriza al usuario para ver cualquier modelo utilizando la política 'viewAny'.
     * Luego, obtiene los modelos filtrados y los devuelve como una colección de recursos en formato JSON.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con la colección de modelos.
     */
    public function index()
    {
        Gate::authorize('viewAny', Modelos::class);
        $modelos = Modelos::Filtered()->get();
        return response()->json(Modelos::resourceCollection($modelos));
    }
/**
 * Crea un nuevo Modelo.
 * @OA\Post(
 *     path="/api/modelos",
 *     summary="Crea un nuevo Modelo.",
 *     security={{"apiAuth":{}}},
 *     tags={"Modelos"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"nombre", "descripcion", "data", "solicitud"},
 *                 @OA\Property(
 *                     property="nombre",
 *                     type="string",
 *                     example="Alumnos"
 *                 ),
 *                 @OA\Property(
 *                     property="descripcion",
 *                     type="string",
 *                     example="Informaciondelosalumnos"
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         required={"nombre", "descripcion", "tipo"},
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="nombredelalumno"
 *                         ),
 *                         @OA\Property(
 *                             property="tipo",
 *                             type="string",
 *                             example="string"
 *                         )
 *                     )
 *                 ),
 *                 @OA\Property(
 *                     property="solicitud",
 *                     type="string",
 *                     example="9d93c2ee-c35f-483e-a344-12638fb01d40",
 *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Modelo creado exitosamente.",
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
 *                         example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="modelo"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informaciondelosalumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="solicitud",
 *                             type="string",
 *                             example="9d93c2ee-c35f-483e-a344-12638fb01d40"
 *                         ),
 *                         @OA\Property(
 *                             property="data",
 *                             type="array",
 *                             @OA\Items(
 *                                 type="object",
 *                                 @OA\Property(
 *                                     property="nombre",
 *                                     type="string",
 *                                     example="nombre"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="descripcion",
 *                                     type="string",
 *                                     example="nombredelalumno"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="tipo",
 *                                     type="string",
 *                                     example="string"
 *                                 )
 *                             )
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="Solicitud inválida.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Solicitud inválida."}
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     )
 * )
 */

    /**
     * Almacena un nuevo modelo en la base de datos.
     *
     * Este método valida la solicitud entrante, autoriza la acción de creación
     * utilizando Gate, crea un nuevo modelo con los datos validados y devuelve
     * una respuesta JSON con el recurso del modelo creado y un código de estado 201.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP entrante.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con el recurso del modelo creado.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        Gate::authorize('create', Modelos::class);
        $modelo = Modelos::createModelo($data);
        return response()->json($modelo->resource(), 201);
    }

/**
 * Muestra la información de un Modelo específico.
 * @OA\Get(
 *     path="/api/modelos/{id}",
 *     summary="Obtiene la información de un Modelo específico.",
 *     security={{"apiAuth":{}}},
 *     tags={"Modelos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
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
 *                         example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="modelo"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informaciondelosalumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="solicitud",
 *                             type="string",
 *                             example="9d93c2ee-c35f-483e-a344-12638fb01d40"
 *                         ),
 *                         @OA\Property(
 *                             property="data",
 *                             type="array",
 *                             @OA\Items(
 *                                 type="object",
 *                                 @OA\Property(
 *                                     property="nombre",
 *                                     type="string",
 *                                     example="nombre"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="descripcion",
 *                                     type="string",
 *                                     example="nombredelalumno"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="tipo",
 *                                     type="string",
 *                                     example="string"
 *                                 )
 *                             )
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
     * Muestra el modelo especificado.
     *
     * @param  int  $id  El ID del modelo a mostrar.
     * @return \Illuminate\Http\JsonResponse  La respuesta JSON con los datos del modelo.
     * @throws \Illuminate\Auth\Access\AuthorizationException  Si el usuario no está autorizado para ver el modelo.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  Si no se encuentra el modelo con el ID especificado.
     */
    public function show($id)
    {
        $modelo = Modelos::findOrFail($id);
        Gate::authorize('view', $modelo);
        return response()->json(
            $modelo->resource()
        );
    }

/**
 * Actualiza un Modelo existente.
 * @OA\Put(
 *     path="/api/modelos/{id}",
 *     summary="Actualiza un Modelo existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"Modelos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 required={"nombre", "descripcion", "data", "solicitud"},
 *                 @OA\Property(
 *                     property="nombre",
 *                     type="string",
 *                     example="Alumnos"
 *                 ),
 *                 @OA\Property(
 *                     property="descripcion",
 *                     type="string",
 *                     example="Informaciondelosalumnos"
 *                 ),
 *                 @OA\Property(
 *                     property="data",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         required={"nombre", "descripcion", "tipo"},
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="nombre"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="nombredelalumno"
 *                         ),
 *                         @OA\Property(
 *                             property="tipo",
 *                             type="string",
 *                             example="string"
 *                         )
 *                     )
 *                 ),
 *                 @OA\Property(
 *                     property="solicitud",
 *                     type="string",
 *                     example="9d93c2ee-c35f-483e-a344-12638fb01d40",
 *                     pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Modelo actualizado exitosamente.",
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
 *                         example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="modelo"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Informaciondelosalumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="solicitud",
 *                             type="string",
 *                             example="9d93c2ee-c35f-483e-a344-12638fb01d40"
 *                         ),
 *                         @OA\Property(
 *                             property="data",
 *                             type="array",
 *                             @OA\Items(
 *                                 type="object",
 *                                 @OA\Property(
 *                                     property="nombre",
 *                                     type="string",
 *                                     example="nombre"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="descripcion",
 *                                     type="string",
 *                                     example="nombredelalumno"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="tipo",
 *                                     type="string",
 *                                     example="string"
 *                                 )
 *                             )
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="400",
 *         description="Solicitud inválida.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Solicitud inválida."}
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     )
 * )
 */

    /**
     * Actualiza un modelo existente.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados.
     * @param int $id El identificador del modelo a actualizar.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON que contiene el recurso del modelo actualizado.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para actualizar el modelo.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el modelo con el ID proporcionado.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $modelo = Modelos::findOrFail($id);
        Gate::authorize('update', $modelo);
        $modelo->updateModelo($data);
        return response()->json($modelo->resource());
    }

/**
 * Elimina un Modelo existente.
 * @OA\Delete(
 *     path="/api/modelos/{id}",
 *     summary="Elimina un Modelo existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"Modelos"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d93c2ee-c748-49e4-bbdb-0890751f606c"
 *         )
 *     ),
 *     @OA\Response(
 *         response="204",
 *         description="Modelo eliminado exitosamente.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json"
 *         )
 *     ),
 *     @OA\Response(
 *         response="404",
 *         description="Recurso no encontrado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Not found."}
 *         )
 *     ),
 *     @OA\Response(
 *         response="500",
 *         description="Error interno del servidor. Por favor, intenta de nuevo o reporta al administrador.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Error interno del servidor"}
 *         )
 *     )
 * )
 */
    /**
     * Elimina un modelo específico.
     *
     * @param  int  $id  El ID del modelo a eliminar.
     * @return \Illuminate\Http\JsonResponse  Respuesta JSON con estado 204 (sin contenido) si la eliminación fue exitosa.
     * @throws \Illuminate\Auth\Access\AuthorizationException  Si el usuario no está autorizado para eliminar el modelo.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException  Si no se encuentra el modelo con el ID proporcionado.
     */
    public function destroy($id)
    {
        $modelo = Modelos::findOrFail($id);
        Gate::authorize('delete', $modelo);
        $modelo->delete();
        return response()->json(null, 204);
    }

}
