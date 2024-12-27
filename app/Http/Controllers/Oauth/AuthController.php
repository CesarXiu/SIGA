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

class AuthController extends Controller
{
    public function me(Request $request){
        $user = $request->user();
        return response()->json(["data" => [
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
        return response()->json(['message' => $user], 200)->withCookie($cookie)->withCookie($cookie2);;
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
        $permisos = $consumer->getRol->permisos; // Obtener los permisos del rol del consumidor
        $ruta = $request->query('route'); // Obtener la ruta a la que se quiere acceder
        $rutaDB = Ruta::where('ruta', $ruta)->first(); // Buscar la ruta en la base de datos
        if ($rutaDB) { // Si la ruta existe
            $rutaScope = $rutaDB->scope; // Obtener el scope necesario para acceder a la ruta
            $scopeExists = collect($permisos)->contains('scope', $rutaScope); // Verificar si el consumidor tiene el scope necesario

            if (!$scopeExists) { // Si no tiene el scope necesario
            return response()->json(['error' => 'Access denied: Permiso necesario no encontrado','ruta' => $ruta], 403);
            }
        } else {
            return response()->json(['error' => 'Ruta '.$ruta.'no encontrada.'], 404);
        }
        //SI TIENE EL SCOPE NECESARIO PARA ACCEDER A LA RUTA
        return response()->json([
            'Consumidor' => $consumer->getPropietario->email, // Propietario del consumidor
        ], ($scopeExists) ? 200 : 401);
    }
}
