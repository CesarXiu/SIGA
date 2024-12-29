<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        Gate::authorize('viewAny', Ruta::class);
        return response()->json(Ruta::resourceCollection(Ruta::all()));
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
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $ruta = Ruta::findOrFail($id);
        Gate::authorize('update', $ruta);
        $ruta->update($data);
        return response()->json($ruta->resource());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ruta = Ruta::findOrFail($id);
        Gate::authorize('delete', $ruta);
        $ruta->delete();
        return response()->json(null, 204);
    }
}
