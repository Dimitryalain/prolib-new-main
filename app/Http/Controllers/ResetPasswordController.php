<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Visiteur;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomResetPasswordEmail; // Assurez-vous d'importer votre classe de e-mail personnalisé
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.passwords.reset_password_visiteur', ['token' => $token]);
    }


    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $visiteur = Visiteur::where('email', $request->email)->first();

        if (!$visiteur) {
            return redirect()->back()->with('error', 'Utilisateur non trouvé');
        }

        // Vérifiez que le token correspond à celui enregistré en base de données
        $passwordReset = DB::table('password_resets_visiteurs')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$passwordReset) {
            return redirect()->back()->with('error', 'Token de réinitialisation de mot de passe invalide');
        }

        // Mettez à jour le mot de passe de l'utilisateur
        $visiteur->password = Hash::make($request->password);
        $visiteur->save();

        // Supprimez l'entrée de la table password_resets_visiteurs
        DB::table('password_resets_visiteurs')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('welcome')->with('success', 'Mot de passe réinitialisé avec succès');
    }

    public function showVisitorResetForm()
    {
        return view('auth.passwords.reset_visitor',);
    }


    public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $visiteur = Visiteur::where('email', $request->email)->first();

    if (!$visiteur) {
        return back()->withErrors(['email' => 'Utilisateur non trouvé']);
    }

    // Générez un token de réinitialisation de mot de passe
    $token = Str::random(60);

    // Enregistrez le token dans votre base de données
    DB::table('password_resets_visiteurs')->insert([
        'email' => $visiteur->email,
        'token' => $token,
        'created_at' => now(),
    ]);

    // Envoyez l'e-mail personnalisé
    Mail::to($visiteur->email)->send(new CustomResetPasswordEmail($visiteur, $token));

    return back()->with('status', 'Email de réinitialisation de mot de passe envoyé avec succès');
}
 

}
