<?php

namespace App\Http\Controllers\Oauth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
//VALIDACION DE PERMISO A RUTA//
use App\Models\Siga\Ruta;
//<PRUEBAS>//
use Illuminate\Support\Facades\DB;
use App\Models\Siga\Consumidor;
//</PRUEBAS>//
/**
 * @OA\Tag(
 *     name="Autenticación",
 *     description="Rutas utilizadas para la autenticacion."
 * )
 */
class AuthController extends Controller
{
/**
 * Obtener informacion del propietario del token.
 * @OA\Get(
 *     path="/api/me",
 *     summary="Obtener mi informacion.",
 *     security={{"apiAuth":{}}},
 *     tags={"Autenticación"},
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
 *                         example="9da77c25-1bd1-4672-a9be-656f60615a39"
 *                     ),
 *                     @OA\Property(
 *                         property="name",
 *                         type="string",
 *                         example="John Doe"
 *                     ),
 *                     @OA\Property(
 *                         property="email",
 *                         type="string",
 *                         example="johndoe@example.com"
 *                     ),
 *                     @OA\Property(
 *                         property="rol",
 *                         type="string",
 *                         example="admin"
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
    
    public function me(Request $request){
        $user = $request->user();
        return response()->json(data: ["data" => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'rol' => $user->rol
        ]]);
    }
    public function login(Request $request){
        $validated = $request->validate([
            'email' => ['bail', 'required', 'exists:users,email'],
            'password' => ['bail', 'required', 'string'],
        ]);

        if(auth()->attempt($validated)){
            return redirect()->intended();
        }

        return back()->withErrors(['error' => 'Invalid username or password']);
    }
/**
 * Obtener informacion del propietario del token.
 * @OA\Get(
 *     path="/api/logout",
 *     summary="Obtener mi informacion.",
 *     security={{"apiAuth":{}}},
 *     tags={"Autenticación"},
 *     @OA\Response(
 *         response="200",
 *         description="Sesion cerrada correctamente.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"message": "Token y Sesion removidos correctamente"}
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
    public function logout(){
        $user = auth()->user();
        $token = $user->token();
        // Revocar el token
        $token->revoke();
        // Invalidar la sesión
        session()->invalidate();

        // Eliminar las cookies
        $cookie = cookie()->forget('XSRF-TOKEN');
        $cookie2 = cookie()->forget('laravel_session');
        return response()->json(['message' => "Token y Sesion removidos correctamente"], 200)->withCookie($cookie)->withCookie($cookie2);;
    }

    public function register(Request $request){
        $validated = $request->validate([
            'email' => ['bail', 'required', 'email', 'unique:users,email'],
            'name' => ['bail', 'required', 'unique:users,name'],
            'password' => ['bail', 'required', 'string', 'confirmed'],
        ]);

        User::create([
            'email' => $validated['email'],
            'name' => $validated['name'],
            'email_validated_at' => now(),
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('login')->withErrors(['success' => 'Successfully registered.']);
    }
/**
 * Validar el acceso del usuario.
 * @OA\Get(
 *     path="/api/check",
 *     summary="Validar el acceso de un usuario a una ruta.",
 *     security={{"apiAuth":{}}},
 *     tags={"Autenticación"},
 *     @OA\Parameter(
 *         name="ruta",
 *         in="query",
 *         required=true,
 *         description="Nombre de la ruta a validar.",
 *         example="/api/alumnos"
 *     ),
 *     @OA\Parameter(
 *         name="metodo",
 *         in="query",
 *         required=true,
 *         description="Metodo de la solicitud (GET, POST, PUT, DELETE).",
 *         example="GET"
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="Sesion cerrada correctamente.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"Consumidor": "L20390000@chetumal.tecnm.mx"}
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
 *     ),
 *     @OA\Response(
 *         response="403",
 *         description="Recurso no encontrado.",
 *         @OA\MediaType(
 *             mediaType="application/vnd.api+json",
 *             example={"error": "Access denied: Permiso necesario no encontrado"}
 *         )
 *     )
 * )
 */
    public function auth_consumer(Request $request){
        $jwtPayload = $request->bearerToken(); // Obtener el token JWT

        // Decodificar el JWT si es necesario
        $jwt = explode('.', $jwtPayload);
        $payload = json_decode(base64_decode($jwt[1]), true); // Decodificar el payload

        $consumer = Consumidor::where('appid', $payload['aud'])->first(); // Buscar el consumidor por el appid
        if ($consumer) {
            auth()->login($consumer); // Autenticar al consumidor
        } else {
            return response()->json(['error' => 'Consumidor no encontrado'], 404);
        }
        //VALIDAR ACCESO A RUTA
        $permisos = $consumer->getRol->getPermisos; // Obtener los permisos del rol del consumidor
        $ruta = $request->query('route'); // Obtener la ruta a la que se quiere acceder
        $metodo = $request->query('metodo'); // Obtener el método de la petición
        $rutaDB = Ruta::where('ruta', $ruta)->where('metodo', $metodo)->first(); // Buscar la ruta en la base de datos
        if ($rutaDB) { // Si la ruta existe
            $rutaScope = $rutaDB->scope; // Obtener el scope necesario para acceder a la ruta
            $scopeExists = collect($permisos)->contains('scope', $rutaScope); // Verificar si el consumidor tiene el scope necesario

            if (!$scopeExists) { // Si no tiene el scope necesario
            return response()->json(['error' => 'Access denied: Permiso necesario no encontrado','ruta' => $permisos], 403);
            } 
        } else {
            return response()->json(['error' => 'Ruta '.$metodo.' => '.$ruta.' no encontrada.'], 404);
        }
        //SI TIENE EL SCOPE NECESARIO PARA ACCEDER A LA RUTA
        return response()->json([
            'Consumidor' => $consumer->getPropietario->email, // Propietario del consumidor
        ],  200);
    }
}
