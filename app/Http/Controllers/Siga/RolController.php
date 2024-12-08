<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Rol;
use App\Http\Requests\Siga\RolRequest as Request;
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
    public function index()
    {
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
public function store(Request $request)
{
    $data = $request->validated();
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
    public function show($id)
    {
        $rol = Rol::findOrFail($id);
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
    public function update(Request $request, Rol $rol)
    {
        $data = $request->validated();
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
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();
        return response()->json(null, 204);
    }
}

