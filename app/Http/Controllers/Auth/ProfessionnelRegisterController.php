<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Profession;
use App\Models\Avocat;
use App\Models\Architecte;
use App\Models\Coach;
use App\Models\ExpertComptable;
use App\Models\Geometre;
use App\Models\IngenieurConseil;
use App\Models\Notaire;
use App\Models\Huissier;
use App\Models\Dentiste;
use App\Models\Orthophoniste;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class ProfessionnelRegisterController extends Controller
{
     /*
    |--------------------------------------------------------------------------
    | Professionnel Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new professionnal as well as their
    | validation and creation.
    |
    */

    /**
     * Show the notaire registration form.
     *
     * @return \Illuminate\View\View
     */


    public function showRegistrationForm()
    {
        return view('auth.register-professionnel');
    }

    /**
     * Handle a notaire registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'adresse_email' => 'required|string|email|max:255|unique:professions',
            'entreprise_cabinet' => 'required|string|max:255',
            'site_web' => 'nullable|string|max:255',
            'domaine_expertise' => 'required|string|max:255',
            'date_debut_exercice' => 'required|date',
            'education_formation' => 'required|string',
            'profession' => 'required|string',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            
        ]);

        $professionnel = Profession::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'adresse_email' => $request->adresse_email,
            'entreprise_cabinet' => $request->entreprise_cabinet,
            'site_web' => $request->site_web,
            'domaine_expertise' => $request->domaine_expertise,
            'date_debut_exercice' => $request->date_debut_exercice,
            'education_formation' => $request->education_formation,
            'profession' => $request->profession,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
           
        ]);

        return redirect()->back()->with('success', 'Votre compte à été crée avec succès.');
    }
}
