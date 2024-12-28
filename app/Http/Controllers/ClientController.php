<?php

namespace App\Http\Controllers;

use Laravel\Passport\ClientRepository;

class ClientController extends Controller
{
    /*
        Funcion hecha para generar un nuevo cliente, correspondiente a una autenticacion Servidor a Servidor
        Recibe como parametros el id del usuario que se le asignara el cliente y el nombre del cliente
    */
    public static function newClient($user, $name){
        $clientRepository = new ClientRepository();

        // Puedes generar un cliente Password Grant o Client Credentials Grant, dependiendo de lo que necesites
        $client = $clientRepository->create(
            null,
            '', // URI de redirección (si es necesario)
            'consumers', 
            true // Si quieres que sea público o no
        );
        // Actualizar el cliente con el usuario y el nombre
        \DB::table('oauth_clients')
            ->where('id', $client->id)
            ->update([
            'user_id' => $user,
            'name' => $name
            ]);
        // Retornar el id y el secreto del cliente
        return [
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ];
    }
    /**
     * // Funcion para eliminar un cliente
     * Se utiliza cuando el consumidor se crea de manera incorrecta o ya no se necesita
     * @param mixed $client_id
     * @return bool
     */
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
