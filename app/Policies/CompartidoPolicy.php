<?php

namespace App\Policies;

use App\Models\Siga\Compartido;
use App\Models\User;
use App\Models\Siga\Consumidor;


/**
 * Clase CompartidoPolicy
 * 
 * Esta clase define las políticas de autorización para el modelo Compartido.
 */
class CompartidoPolicy
{
    /**
     * Verifica si el usuario tiene permisos para realizar una acción basada en su rol y ciertos filtros de solicitud.
     *
     * @param \App\Models\User $user El usuario que realiza la solicitud.
     * @return bool Verdadero si el usuario tiene permisos, falso en caso contrario.
     *
     * - Si el usuario tiene el rol de 'admin', se le concede permiso automáticamente.
     * - Si los filtros de solicitud contienen 'usuario' y 'activo', se verifica que el ID del usuario coincida y que el estado 'activo' sea 1.
     * - Si el filtro de solicitud contiene 'consumidor', se busca el consumidor y se verifica que el ID del propietario coincida con el ID del usuario.
     */
    public function viewAny(User $user): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        if(!empty(request('filter')['usuario']) && !empty(request('filter')['activo'])){
            return $user->id === (int) request('filter')['usuario'] && request('filter')['activo'] == 1;
        }
        if(!empty(request('filter')['consumidor'])){
            $consumidor = Consumidor::findOrFail(request('filter')['consumidor']);
            return (string)$user->id === (string)$consumidor->propietario;
        }
        return false;
    }

    /**
     * Determina si el usuario puede ver el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Compartido $compartido El modelo Compartido que se desea ver.
     * @return bool Verdadero si el usuario puede ver el modelo, falso en caso contrario.
     * 
     * Casos en los que se aprueba:
     * - El usuario tiene el rol de 'admin'.
     * - El usuario es el propietario del modelo Compartido.
     * - El usuario es el creador del modelo Compartido y el modelo está activo.
     */
    public function view(User $user, Compartido $compartido): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        $propietario = $compartido->getConsumidor['propietario'];
        unset($compartido->getConsumidor);
        return ((string) $user->id === $compartido->usuario && $compartido->activo == 1) || (string) $user->id === (string) $propietario;
    }

    /**
     * Determina si el usuario puede crear modelos.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param array $data Los datos necesarios para crear el modelo.
     * @return bool Verdadero si el usuario puede crear el modelo, falso en caso contrario.
     * 
     * Casos en los que se aprueba:
     * - Si el usuario tiene el rol de 'admin'.
     * - Si el usuario es el propietario del consumidor especificado en los datos.
     */
    public function create(User $user, $data): bool
    {
        if($user->rol === 'admin'){
            return true;
        }else{
            $consumidor = Consumidor::findOrFail($data['consumidor']);
            return $user->id === $consumidor->propietario;
        }
    }

    /**
     * Determina si el usuario puede actualizar el modelo.
     * 
     * Casos en los que se aprueba:
     * - Si el usuario tiene el rol de 'admin'.
     * - Si el usuario es el propietario del modelo Compartido.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Compartido $compartido El modelo Compartido que se desea actualizar.
     * @return bool Verdadero si el usuario puede actualizar el modelo, falso en caso contrario.
     */
    public function update(User $user, Compartido $compartido): bool
    {
        if($user->rol === 'admin'){
            return true;
        }
        $propietario = $compartido->getConsumidor['propietario'];
        unset($compartido->getConsumidor);
        return (string)$user->id === (string)$propietario;
    }

    /**
     * Determina si el usuario puede eliminar el modelo.
     * 
     * Este método permite determinar si un usuario tiene permiso para eliminar un modelo Compartido.
     * 
     * Casos en los que se aprueba:
     * - El usuario tiene el rol de 'admin'.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Compartido $compartido El modelo Compartido que se desea eliminar.
     * @return bool Verdadero si el usuario puede eliminar el modelo, falso en caso contrario.
     */
    public function delete(User $user, Compartido $compartido): bool
    {
        return $user->rol === 'admin';
    }

    /**
     * Determina si el usuario puede restaurar el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Compartido $compartido El modelo Compartido que se desea restaurar.
     * @return bool Siempre retorna falso, ya que no se permite restaurar el modelo.
     */
    public function restore(User $user, Compartido $compartido): bool
    {
        return false;
    }

    /**
     * Determina si el usuario puede eliminar permanentemente el modelo.
     * 
     * @param User $user El usuario que realiza la solicitud.
     * @param Compartido $compartido El modelo Compartido que se desea eliminar permanentemente.
     * @return bool Siempre retorna falso, ya que no se permite eliminar permanentemente el modelo.
     */
    public function forceDelete(User $user, Compartido $compartido): bool
    {
        return false;
    }
}
