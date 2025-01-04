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
    
    /**
     * Método para obtener la información del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene la información del usuario autenticado.
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con los datos del usuario.
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
    /**
     * Maneja el inicio de sesión de un usuario.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene las credenciales del usuario.
     * @return \Illuminate\Http\RedirectResponse Redirige al usuario a la página deseada si las credenciales son correctas,
     * o regresa a la página anterior con un mensaje de error si las credenciales son incorrectas.
     *
     * Validaciones:
     * - 'email': Requerido, debe existir en la tabla 'users' en la columna 'email'.
     * - 'password': Requerido, debe ser una cadena de texto.
     *
     * Autenticación:
     * - Si las credenciales son correctas, redirige al usuario a la página deseada.
     * - Si las credenciales son incorrectas, regresa a la página anterior con un mensaje de error.
     */
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
    /**
     * Método para cerrar sesión del usuario autenticado.
     *
     * Este método realiza las siguientes acciones:
     * 1. Obtiene el usuario autenticado.
     * 2. Revoca el token de autenticación del usuario.
     * 3. Invalida la sesión actual.
     * 4. Elimina las cookies de autenticación.
     *
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con un mensaje de éxito y las cookies eliminadas.
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

    /**
     * Registra un nuevo usuario en la aplicación.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene los datos de registro del usuario.
     * 
     * @return \Illuminate\Http\RedirectResponse Redirige al usuario a la página de inicio de sesión con un mensaje de éxito.
     * 
     * @throws \Illuminate\Validation\ValidationException Si la validación de los datos de entrada falla.
     * 
     * Validaciones:
     * - 'email': Requerido, debe ser un email válido y único en la tabla 'users'.
     * - 'name': Requerido, debe ser único en la tabla 'users'.
     * - 'password': Requerido, debe ser una cadena y debe coincidir con la confirmación de contraseña.
     * 
     * Crea un nuevo usuario con los datos validados y encripta la contraseña antes de guardarla en la base de datos.
     */
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
    /**
     * Autentica a un consumidor basado en un token JWT y valida su acceso a una ruta específica.
     *
     * @param \Illuminate\Http\Request $request La solicitud HTTP que contiene el token JWT y los parámetros de ruta.
     * @return \Illuminate\Http\JsonResponse Una respuesta JSON que indica el resultado de la autenticación y la validación de acceso.
     *
     * Este método realiza las siguientes acciones:
     * 1. Obtiene el token JWT de la solicitud.
     * 2. Decodifica el payload del JWT.
     * 3. Busca al consumidor en la base de datos usando el 'appid' del payload.
     * 4. Si el consumidor existe y está activo, lo autentica.
     * 5. Valida si el rol del consumidor está activo.
     * 6. Obtiene y valida los permisos del rol del consumidor para acceder a la ruta solicitada.
     * 7. Verifica si la ruta y el método existen y están activos en la base de datos.
     * 8. Verifica si el consumidor tiene el scope necesario para acceder a la ruta.
     * 9. Retorna una respuesta JSON con el resultado de la autenticación y la validación de acceso.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si el consumidor no es encontrado.
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException Si el consumidor o su rol están desactivados, o si no tiene los permisos necesarios.
     */
    public function auth_consumer(Request $request){
        $jwtPayload = $request->bearerToken(); // Obtener el token JWT

        // Decodificar el JWT si es necesario
        $jwt = explode('.', $jwtPayload);
        $payload = json_decode(base64_decode($jwt[1]), true); // Decodificar el payload

        $consumer = Consumidor::where('appid', $payload['aud'])->first(); // Buscar el consumidor por el appid
        if ($consumer && $consumer->activo) { // Si el consumidor existe y está activo
            auth()->login($consumer); // Autenticar al consumidor
        } else {
            return response()->json(['error' => 'Consumidor no encontrado o desactivado'], 404);
        }
        //VALIDAR ACCESO A RUTA
        $permisos = $consumer->getRol->getPermisos; // Obtener los permisos del rol del consumidor
        if(!$consumer->getRol->activo){
            return response()->json(['error' => 'Access denied: Rol desactivado'], 403);
        }
        $ruta = $request->query('route'); // Obtener la ruta a la que se quiere acceder
        $metodo = $request->query('metodo'); // Obtener el método de la petición
        $rutaDB = Ruta::where('ruta', $ruta)->where('metodo', $metodo)->first(); // Buscar la ruta en la base de datos
        if ($rutaDB && $rutaDB->activo) { // Si la ruta existe
            $scope = $rutaDB->getScope; // Obtener el scope necesario para acceder a la ruta
            $endpoint = $rutaDB->getEndpoint;
            if($scope->activo && $endpoint->activo){
                $rutaScope = $scope->scid; // Obtener el scope necesario para acceder a la ruta
                $scopeExists = collect($permisos)->contains('scope', $rutaScope); // Verificar si el consumidor tiene el scope necesario
                if (!$scopeExists) { // Si no tiene el scope necesario
                    return response()->json(['error' => 'Access denied: Permiso necesario no encontrado','ruta' => $permisos], 403);
                }
            }else{
                return response()->json(['error' => 'Access denied: Scope o Endpoint desactivado'], 403);
            }
        } else {
            return response()->json(['error' => 'Ruta '.$metodo.' => '.$ruta.' no encontrada o desactivada'], 404);
        }
        //SI TIENE EL SCOPE NECESARIO PARA ACCEDER A LA RUTA
        return response()->json([
            'Consumidor' => $consumer->getPropietario->email, // Propietario del consumidor
        ],  200);
    }

}
