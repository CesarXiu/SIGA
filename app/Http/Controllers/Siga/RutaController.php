<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Http\Requests\RutaEndPointBulkRequest;
use App\Models\Siga\Ruta;
use App\Http\Requests\Siga\RutaRequest as Request;
use Illuminate\Support\Facades\Gate;
/**
 * @OA\Tag(
 *     name="Rutas",
 *     description="Información sobre las Rutas disponibles."
 * )
 */
class RutaController extends Controller
{
/**
 * Obten la informacion de todas las rutas.
 * @OA\Get(
 *     path="/api/rutas",
 *     summary="Obtienes la informacion de las Rutas.",
 *     security={{"apiAuth":{}}},
 *     tags={"Rutas"},
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
 *                             example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="ruta"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="metodo",
 *                                 type="string",
 *                                 example="POST"
 *                             ),
 *                             @OA\Property(
 *                                 property="descripcion",
 *                                 type="string",
 *                                 example="Endpoint con informacion de Alumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="ruta",
 *                                 type="string",
 *                                 example="/alumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="activo",
 *                                 type="boolean",
 *                                 example=true
 *                             ),
 *                             @OA\Property(
 *                                 property="endpoint",
 *                                 type="string",
 *                                 example="9da77b14-9952-4f11-945c-b40370f82d0a"
 *                             ),
 *                             @OA\Property(
 *                                 property="scope",
 *                                 type="string",
 *                                 example="9da77a10-48ca-41f9-af6c-4422f0f6ce31"
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
     * Muestra una lista de recursos de Ruta.
     *
     * Este método autoriza al usuario para ver cualquier recurso de Ruta
     * utilizando la política de autorización definida en Gate.
     * Luego, devuelve una respuesta JSON con una colección de recursos de Ruta.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con la colección de recursos de Ruta.
     */
    public function index()
    {
        Gate::authorize('viewAny', Ruta::class);
        return response()->json(Ruta::resourceCollection(Ruta::Included()->get()));
    }

/**
 * Guarda una nueva ruta.
 * @OA\Post(
 *     path="/api/rutas",
 *     summary="Guarda una nueva Ruta.",
 *     security={{"apiAuth":{}}},
 *     tags={"Rutas"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Endpoint con informacion de Alumnos"
 *             ),
 *             @OA\Property(
 *                 property="metodo",
 *                 type="string",
 *                 enum={"GET", "POST", "PUT", "DELETE"},
 *                 example="POST"
 *             ),
 *             @OA\Property(
 *                 property="ruta",
 *                 type="string",
 *                 example="/alumnos",
 *                 pattern="^\/[a-z0-9\-\/\{\}]+$"
 *             ),
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="endpoint",
 *                 type="string",
 *                 example="9da77b14-9952-4f11-945c-b40370f82d0a",
 *                 pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *             ),
 *             @OA\Property(
 *                 property="scope",
 *                 type="string",
 *                 example="9da77a10-48ca-41f9-af6c-4422f0f6ce31",
 *                 pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Ruta creada exitosamente.",
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
 *                         example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="ruta"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="metodo",
 *                             type="string",
 *                             example="POST"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Endpoint con informacion de Alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="ruta",
 *                             type="string",
 *                             example="/alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="activo",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="endpoint",
 *                             type="string",
 *                             example="9da77b14-9952-4f11-945c-b40370f82d0a"
 *                         ),
 *                         @OA\Property(
 *                             property="scope",
 *                             type="string",
 *                             example="9da77a10-48ca-41f9-af6c-4422f0f6ce31"
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
     * Almacena una nueva ruta en la base de datos.
     *
     * Este método autoriza al usuario para crear una nueva ruta utilizando
     * la política de autorización 'create' en el modelo Ruta. Luego, valida
     * los datos de la solicitud y crea una nueva instancia de Ruta con los
     * datos validados. Finalmente, devuelve una respuesta JSON con los
     * recursos de la nueva ruta creada.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos de la nueva ruta.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con los recursos de la nueva ruta creada.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Ruta::class);
        $data = $request->validated();
        $ruta = Ruta::create($data);
        return response()->json($ruta->resource());
    }

/**
 * Obten la informacion de una ruta.
 * @OA\Get(
 *     path="/api/rutas/{id}",
 *     summary="Obtienes la informacion de una Ruta.",
 *     security={{"apiAuth":{}}},
 *     tags={"Rutas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9da77c25-1bd1-4672-a9be-656f60615a39"
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
 *                         @OA\Property(
 *                             property="id",
 *                             type="string",
 *                             example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="ruta"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="metodo",
 *                                 type="string",
 *                                 example="POST"
 *                             ),
 *                             @OA\Property(
 *                                 property="descripcion",
 *                                 type="string",
 *                                 example="Endpoint con informacion de Alumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="ruta",
 *                                 type="string",
 *                                 example="/alumnos"
 *                             ),
 *                             @OA\Property(
 *                                 property="activo",
 *                                 type="boolean",
 *                                 example=true
 *                             ),
 *                             @OA\Property(
 *                                 property="endpoint",
 *                                 type="string",
 *                                 example="9da77b14-9952-4f11-945c-b40370f82d0a"
 *                             ),
 *                             @OA\Property(
 *                                 property="scope",
 *                                 type="string",
 *                                 example="9da77a10-48ca-41f9-af6c-4422f0f6ce31"
 *                             )
 *                         )
 *                     )
 *                 )
 *             )
 *         ),
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
     * Muestra la información de una ruta específica.
     *
     * @param int $id El ID de la ruta a mostrar.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con los datos de la ruta.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para ver la ruta.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra la ruta con el ID proporcionado.
     */
    public function show($id)
    {
        $ruta = Ruta::findOrFail($id);
        Gate::authorize('view', $ruta);
        return response()->json($ruta->resource());
    }

/**
 * Modifica informacion de una ruta.
 * @OA\Put(
 *     path="/api/rutas/{id}",
 *     summary="Modifica una ruta existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"Rutas"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Endpoint con informacion de Alumnos"
 *             ),
 *             @OA\Property(
 *                 property="metodo",
 *                 type="string",
 *                 enum={"GET", "POST", "PUT", "DELETE"},
 *                 example="POST"
 *             ),
 *             @OA\Property(
 *                 property="ruta",
 *                 type="string",
 *                 example="/alumnos",
 *                 pattern="^\/[a-z0-9\-\/\{\}]+$"
 *             ),
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="endpoint",
 *                 type="string",
 *                 example="9da77b14-9952-4f11-945c-b40370f82d0a",
 *                 pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *             ),
 *             @OA\Property(
 *                 property="scope",
 *                 type="string",
 *                 example="9da77a10-48ca-41f9-af6c-4422f0f6ce31",
 *                 pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[1-5][0-9a-fA-F]{3}-[89abAB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Ruta creada exitosamente.",
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
 *                         example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="ruta"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="metodo",
 *                             type="string",
 *                             example="POST"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Endpoint con informacion de Alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="ruta",
 *                             type="string",
 *                             example="/alumnos"
 *                         ),
 *                         @OA\Property(
 *                             property="activo",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="endpoint",
 *                             type="string",
 *                             example="9da77b14-9952-4f11-945c-b40370f82d0a"
 *                         ),
 *                         @OA\Property(
 *                             property="scope",
 *                             type="string",
 *                             example="9da77a10-48ca-41f9-af6c-4422f0f6ce31"
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
     * Actualiza una ruta existente con los datos proporcionados en la solicitud.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados para actualizar la ruta.
     * @param int $id El ID de la ruta que se va a actualizar.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON que contiene la representación de la ruta actualizada.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para actualizar la ruta.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra una ruta con el ID proporcionado.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $ruta = Ruta::findOrFail($id);
        Gate::authorize('update', $ruta);
        $ruta->update($data);
        return response()->json($ruta->resource());
    }
    /**
     * Actualiza en masa los endpoints de las rutas especificadas.
     *
     * @param \App\Http\Requests\RutaEndPointBulkRequest $request La solicitud que contiene los datos validados.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con un mensaje de éxito.
     *
     * Este método recibe una solicitud con los datos validados, obtiene las rutas especificadas
     * y actualiza el endpoint de cada una de ellas. Finalmente, devuelve una respuesta JSON
     * indicando que las rutas fueron actualizadas correctamente.
     */
    public function bulkUpdate(RutaEndPointBulkRequest $request)
    {
        $data = $request->validated();
        $rutas = Ruta::whereIn('ruid', $data['rutas'])->get();
        $rutas->each(function($ruta) use ($data){
            $ruta->endpoint = $data['endpoint'];
            $ruta->save();
        });
        return response()->json([
            'message' => 'Rutas actualizadas correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * Elimina una ruta específica.
     *
     * @param int $id El ID de la ruta a eliminar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con estado 204 (Sin Contenido) si la eliminación es exitosa.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para eliminar la ruta.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra la ruta con el ID proporcionado.
     */
    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        Gate::authorize('delete', $ruta);
        $ruta->delete();
        return response()->json(null, 204);
    }
}
