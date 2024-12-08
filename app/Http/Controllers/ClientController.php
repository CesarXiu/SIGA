<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
    public static function newClient($user, $name){
        $clientRepository = new ClientRepository();

        // Puedes generar un cliente Password Grant o Client Credentials Grant, dependiendo de lo que necesites
        $client = $clientRepository->create(
            null, // El nombre del cliente
            '', // URI de redirección (si es necesario)
            'consumers', // Tipo de grant (puede ser 'password' o 'client_credentials')
            true // Si quieres que sea público o no
        );
        \DB::table('oauth_clients')
            ->where('id', $client->id)
            ->update(['user_id' => $user]);
        return [
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ];
    }
    public static function deleteClient($client_id){
        $clientRepository = new ClientRepository();
        
        // Verificar si el cliente existe
        $client = $clientRepository->find($client_id);
        if ($client) {
            try {
                $clientRepository->delete($client);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}
