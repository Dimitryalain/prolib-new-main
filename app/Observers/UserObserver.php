<?php

namespace App\Observers;

use App\Models\Audit;
use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        Audit::create([
            'user_id' => auth()->id(), // ID de l'utilisateur actuellement authentifié
            'action' => 'created',
            'model' => 'User',
            'model_id' => $user->id,
            // Autres informations à enregistrer
        ]);
    }

    public function updated(User $user)
    {
        Audit::create([
            'user_id' => auth()->id(),
            'action' => 'updated',
            'model' => 'User',
            'model_id' => $user->id,
            // Autres informations à enregistrer
        ]);
    }

    public function deleted(User $user)
    {
        Audit::create([
            'user_id' => auth()->id(),
            'action' => 'deleted',
            'model' => 'User',
            'model_id' => $user->id,
            // Autres informations à enregistrer
        ]);
    }
}

