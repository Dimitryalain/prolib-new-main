<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RDV; // Correction : importer la classe RDV
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visiteur;



class VisiteurAuthController extends Controller
{
    /**
     * Show the login form for visiteurs.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login-visiteur');
    }

    /**
     * Authenticate the visiteur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('visiteur')->attempt($credentials, $request->remember)) {
            // Supposons que vous récupérez les rendez-vous ici
            $rdvs = RDV::where('visiteur_id', auth('visiteur')->user()->id)->get();
            $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);

            // Passez les rendez-vous à la vue
            return view('visiteur', compact('rdvs','visiteur'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Log the visiteur out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('visiteur')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
