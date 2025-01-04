<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Consumidor;
use App\Http\Requests\Siga\ConsumidorRequest as Request;
use App\Http\Controllers\ClientController;
use App\Models\Siga\Solicitud;
use Illuminate\Support\Facades\Gate;
/**
 * @OA\Tag(
 *     name="Consumidores",
 *     description="Información sobre los usuarios con permisos para consumir la API."
 * )
 */
class ConsumidorController extends Controller
{
/**
 * Obten la informacion de todos los consumidores.
 * @OA\Get(
 *     path="/api/consumidores",
 *     summary="Obtienes la informacion de todas las cuentas de consumidor.",
 *     security={{"apiAuth":{}}},
 *     tags={"Consumidores"},
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
 *                             example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="consumidor"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="residencias"
 *                             ),
 *                             @OA\Property(
 *                                 property="email",
 *                                 type="string",
 *                                 example="mapaches@residencias.com"
 *                             ),
 *                             @OA\Property(
 *                                 property="activo",
 *                                 type="boolean",
 *                                 example=true
 *                             ),
 *                             @OA\Property(
 *                                 property="appid",
 *                                 type="string",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
 *                             ),
 *                             @OA\Property(
 *                                 property="rol",
 *                                 type="string",
 *                                 example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                             ),
 *                             @OA\Property(
 *                                 property="propietario",
 *                                 type="integer",
 *                                 example=2
 *                             ),
 *                             @OA\Property(
 *                                 property="solicitud",
 *                                 type="integer",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
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
    /**
     * Muestra una lista de recursos de Consumidor.
     *
     * Este método autoriza al usuario para ver cualquier recurso de Consumidor
     * utilizando la política de autorización 'viewAny'. Luego, devuelve una
     * colección de recursos de Consumidor en formato JSON, aplicando los
     * métodos 'Included' y 'Filtered' para incluir relaciones y filtrar los
     * resultados según sea necesario.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        Gate::authorize('viewAny', Consumidor::class);
        //return Client::all();
        return response()->json(Consumidor::resourceCollection(Consumidor::Included()->Filtered()->get()));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Almacena un nuevo consumidor en la base de datos.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados del consumidor.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON que contiene los datos del nuevo consumidor, client_id y client_secret.
     * @throws \Exception Si ocurre un error durante la creación del consumidor.
     */
    public function store(Request $request)
    {
        $data = $request->validated();
        Gate::authorize('create', Consumidor::class);
        $newClient = ClientController::newClient($data['propietario'], $data['nombre']);
        $data['appid'] = $newClient['client_id'];
        try {
            $consumidor = Consumidor::create($data);
            if($data['solicitud']){
                $solicitud = Solicitud::findOrFail($data['solicitud']);
                $solicitud->consumidor = $consumidor->coid;
                $solicitud->resuelto = true;
                $solicitud->save();
            }
            return response()->json([
            "data" => [
                "consumidor" => $consumidor->resource()['data'],
                "client_id" => $newClient['client_id'],
                "client_secret" => $newClient['client_secret']
            ]
            ]);
        } catch (\Exception $e) {
            ClientController::deleteClient($newClient['client_id']);
            return response()->json(['error' => 'Failed to create consumidor', 'message' => $e->getMessage(), "data" => $data], 500);
        }
    }

/**
 * Obten la informacion de todos los consumidores.
 * @OA\Get(
 *     path="/api/consumidores/{id}",
 *     summary="Obtienes la informacion de una cuenta de consumidor.",
 *     security={{"apiAuth":{}}},
 *     tags={"Consumidores"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
 *                             example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="consumidor"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="residencias"
 *                             ),
 *                             @OA\Property(
 *                                 property="email",
 *                                 type="string",
 *                                 example="mapaches@residencias.com"
 *                             ),
 *                             @OA\Property(
 *                                 property="activo",
 *                                 type="boolean",
 *                                 example=true
 *                             ),
 *                             @OA\Property(
 *                                 property="appid",
 *                                 type="string",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
 *                             ),
 *                             @OA\Property(
 *                                 property="rol",
 *                                 type="string",
 *                                 example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                             ),
 *                             @OA\Property(
 *                                 property="propietario",
 *                                 type="integer",
 *                                 example=2
 *                             ),
 *                             @OA\Property(
 *                                 property="solicitud",
 *                                 type="integer",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
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
     * Muestra la información de un consumidor específico.
     *
     * @param int $id El ID del consumidor a mostrar.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con la información del consumidor.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para ver el consumidor.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el consumidor con el ID proporcionado.
     */
    public function show($id)
    {
        $consumidor = Consumidor::findOrFail($id);
        Gate::authorize('view', $consumidor);
        return response()->json($consumidor->resource());
    }

/**
 * Actualizar la informacion de un consumidor.
 * @OA\Put(
 *     path="/api/consumidores/{id}",
 *     summary="Actualiza la informacion de una cuenta de consumidor.",
 *     security={{"apiAuth":{}}},
 *     tags={"Consumidores"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
 *                 property="email",
 *                 type="string",
 *                 example="mapaches@residencias.com"
 *             ),
 *             @OA\Property(
 *                 property="activo",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="rol",
 *                 type="string",
 *                 example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *             ),
 *             @OA\Property(
 *                 property="propietario",
 *                 type="string",
 *                 example="2"
 *             ),
 *             @OA\Property(
 *                 property="solicitud",
 *                 type="string",
 *                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
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
 *                         @OA\Property(
 *                             property="id",
 *                             type="string",
 *                             example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="consumidor"
 *                         ),
 *                         @OA\Property(
 *                             property="attributes",
 *                             type="object",
 *                             @OA\Property(
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="residencias"
 *                             ),
 *                             @OA\Property(
 *                                 property="email",
 *                                 type="string",
 *                                 example="mapaches@residencias.com"
 *                             ),
 *                             @OA\Property(
 *                                 property="activo",
 *                                 type="boolean",
 *                                 example=true
 *                             ),
 *                             @OA\Property(
 *                                 property="appid",
 *                                 type="string",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
 *                             ),
 *                             @OA\Property(
 *                                 property="rol",
 *                                 type="string",
 *                                 example="9d4b5f15-c250-4ac0-9a41-f8c9c2155d05"
 *                             ),
 *                             @OA\Property(
 *                                 property="propietario",
 *                                 type="integer",
 *                                 example=2
 *                             ),
 *                             @OA\Property(
 *                                 property="solicitud",
 *                                 type="integer",
 *                                 example="9d4b687f-fc63-4054-bf3b-b159f6c124ab"
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
     * Actualiza la información de un consumidor existente.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos validados.
     * @param int $id El ID del consumidor que se va a actualizar.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON con los datos del consumidor actualizado.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para ver el consumidor.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el consumidor con el ID proporcionado.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validated();
        $consumidor = Consumidor::findOrFail($id);
        Gate::authorize('update', $consumidor);
        $consumidor->update($data);
        return response()->json($consumidor->resource());
    }

/**
 * Obten la informacion de todos los consumidores.
 * @OA\Delete(
 *     path="/api/consumidores/{id}",
 *     summary="Obtienes la informacion de una cuenta de consumidor.",
 *     security={{"apiAuth":{}}},
 *     tags={"Consumidores"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Eliminado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"message": "Consumidor eliminado"}
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
     * Elimina un consumidor específico.
     *
     * @param int $id El ID del consumidor a eliminar.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con un mensaje de confirmación.
     * @throws \Illuminate\Auth\Access\AuthorizationException Si el usuario no está autorizado para eliminar el consumidor.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si no se encuentra el consumidor con el ID proporcionado.
     */
    public function destroy( $id)
    {
        $consumidor = Consumidor::findOrFail($id);
        Gate::authorize('delete', $consumidor);
        $consumidor->delete();
        ClientController::deleteClient($consumidor['appid']);
        return response()->json(['message' => 'Consumidor eliminado']);
    }
}
