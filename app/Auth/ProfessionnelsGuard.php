<?php

namespace App\Auth;

use Illuminate\Auth\SessionGuard;

class ProfessionnelsGuard extends SessionGuard
{
    // Méthodes d'authentification pour les professionnels à implémenter ici

    /**
 * Validate a user against the given credentials.
 *
 * @param  mixed  $user
 * @param  array  $credentials
 * @return bool
 */
protected function validateCredentials($user, array $credentials)
{
    $plain = $credentials['password'];

    return app('hash')->check($plain, $user->password);
}

}
