<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Notaire;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VisiteurRegisterController extends Controller
{
    /**
     * Show the visitor registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
      
        return view('auth.register-visiteur');
    }
    


    /**
     * Handle a visitor registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'date_nais' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:visiteurs'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('register-visiteur')
                ->withErrors($validator)
                ->withInput();
        }

        $visiteur = Visiteur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'date_nais' => $request->date_nais,
        ]);

    return redirect()->back()->with('success', 'Votre compte à été crée avec succès.');

    }
}
