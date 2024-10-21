<?php

namespace App\Http\Controllers\Oauth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Passport\User;
use Illuminate\Support\Facades\Hash;
//<PRUEBAS>//
use Illuminate\Support\Facades\DB;
use App\Models\Siga\Consumidor;
//</PRUEBAS>//

class AuthController extends Controller
{
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
        $rol = $request->user();
        //dd($rol);
        \Log::info('Query Log:', DB::getQueryLog());
        return response()->json([
            'consumer' => $consumer->getRol
        ]);
    }
}
