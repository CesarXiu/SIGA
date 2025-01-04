<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Rol;
use App\Http\Requests\Siga\RolRequest as Request;
use Illuminate\Support\Facades\Gate;
/**
 * @OA\Tag(
 *     name="Roles",
 *     description="Información sobre los Roles disponibles."
 * )
 */
class RolController extends Controller
{
/**
 * Obten la informacion de todos los Roles.
 * @OA\Get(
 *     path="/api/roles",
 *     summary="Obtienes la informacion de los Roles.",
 *     security={{"apiAuth":{}}},
 *     tags={"Roles"},
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
 *                             example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="rol"
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
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="residencias"
 *                             ),
 *                             @OA\Property(
 *                                 property="descripcion",
 *                                 type="string",
 *                                 example="Acceso a informacion vital para el proceso de residencias"
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
     * Muestra una lista de roles.
     *
     * Este método autoriza al usuario para ver cualquier rol utilizando la política 'viewAny'.
     * Luego, devuelve una respuesta JSON con una colección de recursos de roles,
     * incluyendo las relaciones especificadas en el método 'Included'.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con la colección de roles.
     */
    public function index()
    {
        Gate::authorize('viewAny', Rol::class);
        return response()->json(Rol::resourceCollection(Rol::Included()->get()));
    }
/**
 * Crea un nuevo Rol.
 * @OA\Post(
 *     path="/api/roles",
 *     summary="Crea un nuevo Rol.",
 *     security={{"apiAuth":{}}},
 *     tags={"Roles"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="residencias"
 *             ),
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Acceso a informacion vital para el proceso de residencias"
 *             ),
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="201",
 *         description="Rol creado exitosamente.",
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
 *                         example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="rol"
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
 *                             example="residencias"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Acceso a informacion vital para el proceso de residencias"
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
 *         response="400",
 *         description="Solicitud incorrecta.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Solicitud incorrecta."}
 *         )
 *     )
 * )
 */

    /**
     * Almacena un nuevo rol en la base de datos.
     *
     * Este método valida la solicitud entrante, autoriza la creación de un nuevo rol
     * y luego crea el rol con los datos proporcionados. Finalmente, devuelve una
     * respuesta JSON con el recurso del rol creado y un código de estado 201.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos del rol.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con el recurso del rol creado y un código de estado 201.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        Gate::authorize('create', Rol::class);
        $rol = Rol::create($data);
        return response()->json($rol->resource(), 201);
    }

/**
 * Obten la informacion de un Rol especifico.
 * @OA\Get(
 *     path="/api/roles/{id}",
 *     summary="Obtienes la informacion de un Rol especifico.",
 *     security={{"apiAuth":{}}},
 *     tags={"Roles"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
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
 *                         example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="rol"
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
 *                             example="residencias"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Acceso a informacion vital para el proceso de residencias"
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
     * Muestra la información de un rol específico.
     *
     * @param int $id El ID del rol a mostrar.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con la información del rol.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para ver el rol.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el rol con el ID proporcionado.
     */
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
        Gate::authorize('view', $rol);
        return response()->json($rol->resource());
    }

/**
 * Actualiza un Rol existente.
 * @OA\Put(
 *     path="/api/roles/{id}",
 *     summary="Actualiza un Rol existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"Roles"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="residencias"
 *             ),
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Acceso a informacion vital para el proceso de residencias"
 *             ),
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example=true
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Rol actualizado exitosamente.",
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
 *                         example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="rol"
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
 *                             example="residencias"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Acceso a informacion vital para el proceso de residencias"
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
 *         response="400",
 *         description="Solicitud incorrecta.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Solicitud incorrecta."}
 *         )
 *     )
 * )
 */
    /**
     * Actualiza un rol existente.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados.
     * @param int $id El ID del rol a actualizar.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con el recurso del rol actualizado.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para actualizar el rol.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el rol con el ID proporcionado.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $rol = Rol::findOrFail($id);
        Gate::authorize('update', $rol);
        $rol->update($data);
        return response()->json($rol->resource());
    }

/**
 * Elimina un Rol existente.
 * @OA\Delete(
 *     path="/api/roles/{id}",
 *     summary="Elimina un Rol existente.",
 *     security={{"apiAuth":{}}},
 *     tags={"Roles"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *         )
 *     ),
 *     @OA\Response(
 *         response="204",
 *         description="Rol eliminado exitosamente.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json"
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
     * Elimina un rol específico.
     *
     * @param int $id El ID del rol a eliminar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con estado 204 (No Content) si la eliminación fue exitosa.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para eliminar el rol.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el rol con el ID proporcionado.
     */
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        Gate::authorize('delete', $rol);
        $rol->delete();
        return response()->json(null, 204);
    }
}

