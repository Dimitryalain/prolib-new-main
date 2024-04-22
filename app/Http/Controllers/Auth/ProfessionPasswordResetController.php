<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\Profession; // Assurez-vous d'importer le modèle Profession

class ProfessionPasswordResetController extends Controller
{
    use SendsPasswordResetEmails;

    protected function broker()
    {
        return Password::broker('professions');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email-profession');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }
}
