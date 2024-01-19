<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\UserProvider;

class VisiteurGuard extends SessionGuard
{
    /**
     * Create a new authentication guard.
     *
     * @param  string  $name
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Session\SessionInterface  $session
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $stateful
     * @return void
     */
    public function __construct($name,
                                UserProvider $provider,
                                $session,
                                $stateful = true)
    {
        parent::__construct($name, $provider, $session, null, null);

        $this->stateful = $stateful;
    }

    // Vous pouvez ajouter des méthodes d'authentification personnalisées ici

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    protected function validateCredentials($user, array $credentials)
    {
        // Logique de validation des identifiants, par exemple, vérification du mot de passe
        $plain = $credentials['password'];

        return app('hash')->check($plain, $user->password);
    }
}
