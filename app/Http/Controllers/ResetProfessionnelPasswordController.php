<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Profession;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfessionnelResetPasswordEmail; // Assurez-vous d'importer votre classe de e-mail personnalisé
use Illuminate\Support\Str;



class ResetProfessionnelPasswordController extends Controller
{
    public function showVisitorResetForm()
    {
        return view('auth.passwords.reset_professionnel',);
    }


    public function sendResetLinkEmailProfessionnel(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $professionnel = Profession::where('adresse_email', $request->adresse_email)->first();

    if (!$professionnel) {
        return back()->withErrors(['email' => 'Utilisateur non trouvé']);
    }

    // Générez un token de réinitialisation de mot de passe
    $token = Str::random(60);

    // Enregistrez le token dans votre base de données
    DB::table('password_resets_professions')->insert([
        'email' => $professionnel->email,
        'token' => $token,
        'created_at' => now(),
    ]);

    // Envoyez l'e-mail personnalisé
    Mail::to($professionnel->email)->send(new ProfessionnelResetPasswordEmail($professionnel, $token));

    return back()->with('status', 'Email de réinitialisation de mot de passe envoyé avec succès');
}

}
