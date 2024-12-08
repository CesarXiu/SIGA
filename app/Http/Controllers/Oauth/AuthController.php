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
        DB::connection()->enableQueryLog();

        // Decodificar el JWT si es necesario
        $jwt = explode('.', $jwtPayload);
        $payload = json_decode(base64_decode($jwt[1]), true); // Decodificar el payload

        $consumer = Consumidor::where('appid', $payload['aud'])->first(); // Buscar el consumidor por el appid
        //dd($consumer);
        if ($consumer) {
            auth()->login($consumer); // Autenticar al consumidor
        } else {
            return response()->json(['error' => 'Consumer not found'], 404);
        }
        $rol = $request->user()  ;
        //dd($rol);
        //VALIDAR ACCESO A RUTA
        $permisos = $consumer->getRol->permisos;
        $ruta = $request->query('route');
        $rutaDB = Ruta::where('ruta', $ruta)->first();
        if ($rutaDB) {
            $rutaScope = $rutaDB->scope;
            $scopeExists = collect($permisos)->contains('scope', $rutaScope);

            if (!$scopeExists) {
            return response()->json(['error' => 'Access denied: scope not found in permissions','ruta' => $ruta], 403);
            }
        } else {
            return response()->json(['error' => 'Route not found'], 404);
        }
        //->getScope
        \Log::info('Query Log:', DB::getQueryLog());
        return response()->json([
            'consumer' => $consumer->getRol,
            'acceso' => ($scopeExists) ? 'Permitido' : 'Denegado'
        ], ($scopeExists) ? 200 : 401);
    }
}
