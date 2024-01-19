<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User; // Assurez-vous d'importer le modèle User

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Récupérez les informations de connexion de l'utilisateur
        $email = $request->input('email');
        $password = $request->input('password');

        // Récupérez l'utilisateur par son adresse e-mail
        $user = User::where('email', $email)->first();

        // Vérifiez si l'utilisateur existe et s'il est actif
        if ($user && $user->action === 1) {
            // L'utilisateur est inactif, renvoyez une erreur
            throw ValidationException::withMessages([
                $this->username() => __('Votre compte a été temporairement suspendu. Veuillez contacter l\'administrateur E-THIK +225 05 85 00 03 00 / 07 49 48 08 66'),
            ]);
        }

        // Utilisez la méthode parente pour vérifier l'authentification
        if ($this->attemptLogin($request, $email, $password)) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }
}
