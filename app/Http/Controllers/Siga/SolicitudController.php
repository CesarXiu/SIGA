<?php

namespace App\Http\Controllers\Siga;

use App\Http\Controllers\Controller;
use App\Models\Siga\Solicitud;
use App\Http\Requests\Siga\SolicitudRequest as Request;
use App\Http\Requests\Siga\SolicitudUpdateRequest as UpdateRequest;
use App\Models\Siga\Modelos;
/**
 * @OA\Tag(
 *     name="Solicitudes",
 *     description="Información sobre las solicitudes de informacion hechas al SII."
 * )
 */
class SolicitudController extends Controller
{
/**
 * Obten la informacion de todas las solicitudes.
 * @OA\Get(
 *     path="/api/solicitudes",
 *     summary="Obtienes la informacion de las Solicitudes.",
 *     security={{"apiAuth":{}}},
 *     tags={"Solicitudes"},
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
 *                  @OA\Items(
 *                     @OA\Property(
 *                         property="id",
 *                         type="string",
 *                         example="9d992375-4091-4182-9e9b-789c0c569537"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="solicitud"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Residencias Profesionales"
 *                         ),
 *                         @OA\Property(
 *                             property="correo",
 *                             type="string",
 *                             example="cesarx@gmail.com"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Esta es la nueva descripcion de la solicitud"
 *                         ),
 *                         @OA\Property(
 *                             property="resuelto",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="propietario",
 *                             type="integer",
 *                             example=1
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="relationships",
 *                         type="array",
 *                         @OA\Items()
 *                     )
 *                 )
 *               )
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
        return response()->json(
            Solicitud::resourceCollection(Solicitud::Included()->get())
        );
    }

/**
 * Se creara la solicitud y sus modelos todo en una misma peticion.
 * @OA\Post(
 *     path="/api/solicitudes",
 *     summary="Crea una nueva solicitud de informacion.",
 *     security={{"apiAuth":{}}},
 *     tags={"Solicitudes"},
 *    @OA\RequestBody(
 *     @OA\MediaType(
 *         mediaType="application/vnd.api+json",
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="Residencias Profesionales"
 *             ),
 *             @OA\Property(
 *                 property="correo",
 *                 type="string",
 *                 example="cesarx@gmail.com"
 *             ),
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Esta es la nueva descripcion de la solicitud"
 *             ),
 *             @OA\Property(
 *                 property="resuelto",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="archivos",
 *                 type="array",
 *                 @OA\Items(
 *                     @OA\Property(
 *                         property="nombre",
 *                         type="string",
 *                         example="Archivo 1"
 *                     ),
 *                     @OA\Property(
 *                         property="descripcion",
 *                         type="string",
 *                         example="Descripcion del archivo 1"
 *                     ),
 *                     @OA\Property(
 *                         property="data",
 *                         type="array",
 *                         @OA\Items(
 *                             @OA\Property(
 *                                 property="nombre",
 *                                 type="string",
 *                                 example="Dato 1"
 *                             ),
 *                             @OA\Property(
 *                                 property="descripcion",
 *                                 type="string",
 *                                 example="Descripcion del dato 1"
 *                             ),
 *                             @OA\Property(
 *                                 property="tipo",
 *                                 type="string",
 *                                 enum={"int", "string", "boolean"},
 *                                 example="string"
 *                             )
 *                         )
 *                     )
 *                 )
 *             ),
 *             @OA\Property(
 *                 property="propietario",
 *                 type="string",
 *                 example="1"
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
 *                         example="9d992375-4091-4182-9e9b-789c0c569537"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="solicitud"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Residencias Profesionales"
 *                         ),
 *                         @OA\Property(
 *                             property="correo",
 *                             type="string",
 *                             example="cesarx@gmail.com"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Esta es la nueva descripcion de la solicitud"
 *                         ),
 *                         @OA\Property(
 *                             property="resuelto",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="propietario",
 *                             type="integer",
 *                             example=1
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="relationships",
 *                         type="object",
 *                         @OA\Property(
 *                             property="modelos",
 *                             type="array",
 *                             @OA\Items(
 *                                 @OA\Property(
 *                                     property="moid",
 *                                     type="string",
 *                                     example="9d992376-e922-4853-8b8e-6de495ddd3cc"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="nombre",
 *                                     type="string",
 *                                     example="Alumnos"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="descripcion",
 *                                     type="string",
 *                                     example="Informacion de los alumnos"
 *                                 ),
 *                                 @OA\Property(
 *                                     property="campos",
 *                                     type="array",
 *                                     @OA\Items(
 *                                         @OA\Property(
 *                                             property="nombre",
 *                                             type="string",
 *                                             example="nombre"
 *                                         ),
 *                                         @OA\Property(
 *                                             property="descripcion",
 *                                             type="string",
 *                                             example="nombre del alumno"
 *                                         ),
 *                                         @OA\Property(
 *                                             property="tipo",
 *                                             type="string",
 *                                             example="string"
 *                                         )
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
    public function store(Request $request)
    {
        $data = $request->validated();
        $solicitud = Solicitud::create($data);
        $modelos = $data['archivos'];
        foreach($modelos as $modelo){
            $model = new Modelos();
            $model->nombre = $modelo['nombre'];
            $model->descripcion = $modelo['descripcion'];
            $model->solicitud = $solicitud->soid;
            $model->storeData($modelo['data']);
            $model->save();
        }
        $solicitud->getModelos;
        return response()->json(
            $solicitud->resource()
        );
    }

/**
 * Obten la informacion de una Solicitud.
 * @OA\Get(
 *     path="/api/solicitudes/{id}",
 *     summary="Obtienes la informacion de la solicitud indicada.",
 *     security={{"apiAuth":{}}},
 *     tags={"Solicitudes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="UUID de la Solicitud",
 *         @OA\Schema(
 *             type="string",
 *             example="9d992375-4091-4182-9e9b-789c0c569537"
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
 *                         example="9d992375-4091-4182-9e9b-789c0c569537"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="solicitud"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Residencias Profesionales"
 *                         ),
 *                         @OA\Property(
 *                             property="correo",
 *                             type="string",
 *                             example="cesarx@gmail.com"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Esta es la nueva descripcion de la solicitud"
 *                         ),
 *                         @OA\Property(
 *                             property="resuelto",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="propietario",
 *                             type="integer",
 *                             example=1
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="relationships",
 *                         type="array",
 *                         @OA\Items()
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
        $solicitud = Solicitud::Included()->findOrFail($id);
        return response()->json(
            $solicitud->resource()
        );
    }

/**
 * Actualiza la informacion de una Solicitud.
 * @OA\Patch(
 *     path="/api/solicitudes/{id}",
 *     summary="Actualiza la informacion de la solicitud indicada.",
 *     security={{"apiAuth":{}}},
 *     tags={"Solicitudes"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="UUID de la Solicitud",
 *         @OA\Schema(
 *             type="string",
 *             example="9d992375-4091-4182-9e9b-789c0c569537"
 *         )
 *     ),
 *    @OA\RequestBody(
 *     @OA\MediaType(
 *         mediaType="application/vnd.api+json",
 *         @OA\Schema(
 *             type="object",
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="Residencias Profesionales"
 *             ),
 *             @OA\Property(
 *                 property="correo",
 *                 type="string",
 *                 example="cesarx@gmail.com"
 *             ),
 *             @OA\Property(
 *                 property="descripcion",
 *                 type="string",
 *                 example="Esta es la nueva descripcion de la solicitud"
 *             ),
 *             @OA\Property(
 *                 property="resuelto",
 *                 type="boolean",
 *                 example=true
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
 *                         example="9d992375-4091-4182-9e9b-789c0c569537"
 *                     ),
 *                     @OA\Property(
 *                         property="type",
 *                         type="string",
 *                         example="solicitud"
 *                     ),
 *                     @OA\Property(
 *                         property="attributes",
 *                         type="object",
 *                         @OA\Property(
 *                             property="nombre",
 *                             type="string",
 *                             example="Residencias Profesionales"
 *                         ),
 *                         @OA\Property(
 *                             property="correo",
 *                             type="string",
 *                             example="cesarx@gmail.com"
 *                         ),
 *                         @OA\Property(
 *                             property="descripcion",
 *                             type="string",
 *                             example="Esta es la nueva descripcion de la solicitud"
 *                         ),
 *                         @OA\Property(
 *                             property="resuelto",
 *                             type="boolean",
 *                             example=true
 *                         ),
 *                         @OA\Property(
 *                             property="propietario",
 *                             type="integer",
 *                             example=1
 *                         )
 *                     ),
 *                     @OA\Property(
 *                         property="relationships",
 *                         type="array",
 *                         @OA\Items()
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
    public function update(UpdateRequest $request, $id)
    {
        //dd($id);
        $data = $request->validated();
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->update($data);
        return response()->json(
            $solicitud->resource()
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }
}
