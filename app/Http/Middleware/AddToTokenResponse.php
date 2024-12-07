<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AddToTokenResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Middleware ejecutado antes del procesamiento');
        $response = $next($request);

        if ($request->is('oauth/token') && $response->getStatusCode() === 200) {
            // Obtén las credenciales del usuario
            $email = $request->input('username');
            $password = $request->input('password');
            \Log::info('User accessed oauth/token', [
                'email' => $email,
                'password' => $password,
            ]);
            // Valida las credenciales manualmente
            $user = User::where('email', $email)->first();
            if ($user) {//&& \Hash::check($password, $user->password)
                // Agrega el rol del usuario en el encabezado de la respuesta
                $response->headers->set('X-User-Role', $user->rol);
            }
            if ($user) {
                \Log::info('User accessed oauth/token', [
                'user_id' => $user->id,
                'role' => $user->rol,
                ]);
            }
        }
        \Log::info('User accessed oauth/token on:', [
            'timestamp' => now()->toDateTimeString(),
        ]);
        \Log::info('Middleware ejecutado despues del procesamiento');
        return $response;
    }
}
