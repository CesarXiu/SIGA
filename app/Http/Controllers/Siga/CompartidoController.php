<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompartidoBulkUpdate;
use App\Models\Siga\Compartido;
use App\Http\Requests\Siga\CompartidoRequest as Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
/**
 * @OA\Tag(
 *     name="Compartidos",
 *     description="Información sobre las cuentas compartidas."
 * )
 */
class CompartidoController extends Controller
{
/**
 * Obten la informacion de todas las cuentas Compartidos.
 * @OA\Get(
 *     path="/api/compartidos",
 *     summary="Obtienes la informacion de todas las cuentas compartidas.",
 *     security={{"apiAuth":{}}},
 *     tags={"Compartidos"},
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
 *                             example="9dd9d2d4-6a0a-413f-89af-38f7d313ed1d"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="compartido"
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
 *                                 property="usuario",
 *                                 type="string",
 *                                 example="3"
 *                             ),
 *                             @OA\Property(
 *                                 property="consumidor",
 *                                 type="string",
 *                                 example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
        Gate::authorize('viewAny', Compartido::class);
        $compartidos = Compartido::Included()->Filtered()->get();
        return response()->json(
            Compartido::resourceCollection($compartidos)
        );
    }

/**
 * Compartir una cuenta con un usuario.
 * @OA\Post(
 *     path="/api/compartidos",
 *     summary="Compartir una cuenta de consumidor con otro usuario.",
 *     security={{"apiAuth":{}}},
 *     tags={"Compartidos"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="usuario",
 *                     type="string",
 *                     description="Email del usuario con el que se compartirá la cuenta",
 *                     example="user@example.com"
 *                 ),
 *                 @OA\Property(
 *                     property="consumidor",
 *                     type="string",
 *                     description="ID del consumidor",
 *                     example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *                 ),
 *                 @OA\Property(
 *                     property="activo",
 *                     type="boolean",
 *                     description="Estado de la cuenta compartida",
 *                     example=true
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
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(
 *                             property="id",
 *                             type="string",
 *                             example="9dd9d2d4-6a0a-413f-89af-38f7d313ed1d"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="compartido"
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
 *                                 property="usuario",
 *                                 type="string",
 *                                 example="3"
 *                             ),
 *                             @OA\Property(
 *                                 property="consumidor",
 *                                 type="string",
 *                                 example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
    public function store(Request $request)
    {
        $data = $request->validated();
        Gate::authorize('create',[Compartido::class, $data]); //La validacion se hace desde el request
        $usuario = User::where('email', $data['usuario'])->first();
        $data['usuario'] = $usuario->id;
        $compartido = Compartido::create($data);
        return response()->json($compartido->resource());
    }

/**
 * Obten la informacion de todas las cuentas Compartidos.
 * @OA\Get(
 *     path="/api/compartidos/{compartido}",
 *     summary="Obtienes la informacion de todas las cuentas compartidas.",
 *     security={{"apiAuth":{}}},
 *     tags={"Compartidos"},
 *    @OA\Parameter(
 *          name="compartido",
 *          in="path",
 *          required=true,
 *          description="ID del compartido"
 *    ),
 *     @OA\Response(
 *         response="200",
 *         description="OK",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="data",
 *                         type="object",
 *                         @OA\Property(
 *                             property="id",
 *                             type="string",
 *                             example="9dd9d2d4-6a0a-413f-89af-38f7d313ed1d"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="compartido"
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
 *                                 property="usuario",
 *                                 type="string",
 *                                 example="3"
 *                             ),
 *                             @OA\Property(
 *                                 property="consumidor",
 *                                 type="string",
 *                                 example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
    public function show($id)
    {
        $compartido = Compartido::findOrFail($id);
        Gate::authorize('view',$compartido);
        return response()->json($compartido->resource());
    }

/**
 * Modificar el usuario compartido.
 * @OA\Put(
 *     path="/api/compartidos/{compartido}",
 *     summary="Modificar el usuario compartido.",
 *     security={{"apiAuth":{}}},
 *     tags={"Compartidos"},
 *    @OA\Parameter(
 *          name="compartido",
 *          in="path",
 *          required=true,
 *          description="ID del compartido"
 *    ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             @OA\Schema(
 *                 type="object",
 *                 @OA\Property(
 *                     property="usuario",
 *                     type="string",
 *                     description="Email del usuario con el que se compartirá la cuenta",
 *                     example="user@example.com"
 *                 ),
 *                 @OA\Property(
 *                     property="consumidor",
 *                     type="string",
 *                     description="ID del consumidor",
 *                     example="9d4b6976-119f-479d-a7f8-89d766f91015"
 *                 ),
 *                 @OA\Property(
 *                     property="activo",
 *                     type="boolean",
 *                     description="Estado de la cuenta compartida",
 *                     example=true
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
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(
 *                             property="id",
 *                             type="string",
 *                             example="9dd9d2d4-6a0a-413f-89af-38f7d313ed1d"
 *                         ),
 *                         @OA\Property(
 *                             property="type",
 *                             type="string",
 *                             example="compartido"
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
 *                                 property="usuario",
 *                                 type="string",
 *                                 example="3"
 *                             ),
 *                             @OA\Property(
 *                                 property="consumidor",
 *                                 type="string",
 *                                 example="9d4b6976-119f-479d-a7f8-89d766f91015"
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
    public function update(Request $request, $id)
    {
        $compartido = Compartido::findOrFail($id);
        Gate::authorize('update',$compartido);
        $data = $request->validated();
        $compartido->update([
            'activo' => $data['activo']
        ]);
        return response()->json($compartido->resource());
    }
    public function bulkUpdate(CompartidoBulkUpdate $request)
    {
        $data = $request->validated();
        foreach($data['compartidos'] as $compartidoData){
            $compartido = Compartido::findOrFail($compartidoData['id']);
            Gate::authorize('update', $compartido);
            $compartido->update([
                'activo' => $compartidoData['activo']
            ]);
        }
        return response()->json(["message" => "Compartidos actualizados correctamente"]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compartido $compartido)
    {
        //
    }
}
