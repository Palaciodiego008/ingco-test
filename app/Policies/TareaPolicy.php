<?php

namespace App\Policies;

use App\Models\Tarea;
use App\Models\User;


class TareaPolicy
{
    /**
     * Determine whether the user can update the tarea.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return bool
     */
    public function update(User $user, Tarea $tarea)
    {
        // Esta función determina si el usuario puede actualizar una tarea específica.
        // Por ejemplo, solo el propietario de la tarea puede actualizarla.
        return $user->id === $tarea->user_id;
    }

    /**
     * Determine whether the user can delete the tarea.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Tarea  $tarea
     * @return bool
     */
    public function delete(User $user, Tarea $tarea)
    {
        // Esta función determina si el usuario puede eliminar una tarea específica.
        // Por ejemplo, solo el propietario de la tarea puede eliminarla.
        return $user->id === $tarea->user_id;
    }
}
