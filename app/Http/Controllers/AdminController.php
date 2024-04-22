<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Info;
use App\Models\Profession;
use App\Models\RDV;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Visiteur;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; 
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationCompte;
use App\Mail\DesactiveCompte;


class AdminController extends Controller
{
    public function clients(){
        $visiteurs = Visiteur::all();
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.clients',compact('user','visiteurs'));
    }

    public function recherche_client(Request $request)
    {
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');
    
        // Utilisez la méthode whereBetween pour filtrer les rendez-vous entre deux dates
        $visiteurs = Visiteur::whereBetween('visiteurs.created_at', [$date_debut, $date_fin])->get();
        $user = User::findOrFail(auth()->user()->id);
    
        return view('admin.clients', compact('visiteurs', 'user'));
    }


 // Contrôleur
public function tdb()
    {
    // Obtenez le nombre de professionnels pour chaque catégorie depuis la base de données
    $professions = DB::table('professions')
    ->select('profession', DB::raw('count(*) as count'))
    ->groupBy('profession')
    ->get();

    // Associez chaque profession à une couleur
    $colors = [
        'Avocat' => 'bg-danger',
        'Architecte' => 'bg-warning',
        'Expert Comptable' => 'bg-secondary',
        'Géomètre' => 'bg-success',
        'Coach' => 'bg-primary',
        'Ingenieur Conseil' => 'bg-info',
        'Notaire' => 'bg-dark',
        'Dentiste' => 'bg-info',
        'Huissier' => 'bg-success',
        'Orthophoniste' => 'bg-primary',
        
        
    // Ajoutez d'autres professions et leurs couleurs ici
    ];

    // Calculez le pourcentage pour chaque catégorie
    $totalProfessionnels = $professions->sum('count');
    foreach ($professions as &$profession) {
        $percentage = ($profession->count / $totalProfessionnels) * 100;
        $profession->percentage = number_format($percentage, 0); // Formate le pourcentage avec 2 chiffres après la virgule
        $profession->color = $colors[$profession->profession];
    }

    // Le reste de votre code pour obtenir d'autres données
    $user = User::findOrFail(auth()->user()->id);
    $countRDV = RDV::countRDV();
    $countVisiteur = Visiteur::countVisiteur();
    $CountProfessionnels = Profession::CountProfessionnels();
    $currentYear = Carbon::now()->year;
    $rdvData = RDV::getRDVDataForYear($currentYear);
    $months = [];
    $counts = [];

    for ($month = 1; $month <= 12; $month++) {
        $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
        $months[] = $formattedMonth;

        $monthData = $rdvData->where('month', $formattedMonth)->first();

        if ($monthData) {
            $counts[] = $monthData->count;
        } else {
            $counts[] = 0;
        }
    }

    $statusCounts = RDV::groupBy('statut')
        ->select('statut', DB::raw('count(*) as count'))
        ->get();

    $moyenneNotes = DB::table('rdv')->avg('note');

    return view('admin.tdb', compact('user', 'countRDV', 'countVisiteur', 'CountProfessionnels', 'months', 'counts', 'rdvData', 'statusCounts', 'moyenneNotes', 'professions','colors'));
}
    
    public function demande(){
        $rdvs = RDV::all();
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.demande',compact('user','rdvs'));
    }

    public function recherche_demande(Request $request)
    {
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');
    
        // Utilisez la méthode whereBetween pour filtrer les rendez-vous entre deux dates
        $rdvs = RDV::whereBetween('date_reservation', [$date_debut, $date_fin])->get();
        $user = User::findOrFail(auth()->user()->id);
    
        return view('admin.demande', compact('rdvs', 'user'));
    }

    public function notations(){
        $rdvs = RDV::all();
        $user = User::findOrFail(auth()->user()->id);

        $professionals = Profession::withAvg('rdv', 'note')
        ->orderByDesc('rdv_avg_note')
        ->get()
        ->map(function ($professional) {
            // Formater la moyenne des notes avec un chiffre après la virgule, ou 0 si absent
            $professional->rdv_avg_note = number_format($professional->rdv_avg_note, 1, '.', '');
            return $professional;
        });

            return view('admin.notations',compact('user','rdvs','professionals'));
        }

    public function audit(){
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.audit',compact('user'));
    }

    public function suivi(){
        $rdvs = RDV::all();
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.suivi',compact('user','rdvs'));
    }

    public function recherche_rdv(Request $request)
    {
        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');
    
        // Utilisez la méthode whereBetween pour filtrer les rendez-vous entre deux dates
        $rdvs = RDV::whereBetween('date_reservation', [$date_debut, $date_fin])->get();
        $user = User::findOrFail(auth()->user()->id);
    
        return view('admin.suivi', compact('rdvs', 'user'));
    }
    


    public function professionnel()
{
    $user = User::findOrFail(auth()->user()->id);

    // Récupérez les données de toutes les professions avec des jointures
    $professionnels = DB::table('professions')
        ->leftJoin('avocats', 'professions.id', '=', 'avocats.profession_id')
        ->leftJoin('architectes', 'professions.id', '=', 'architectes.profession_id')
        ->leftJoin('expert_comptables', 'professions.id', '=', 'expert_comptables.profession_id')
        ->leftJoin('geometres', 'professions.id', '=', 'geometres.profession_id')
        ->leftJoin('coachs', 'professions.id', '=', 'coachs.profession_id')
        ->leftJoin('ingenieurs_conseils', 'professions.id', '=', 'ingenieurs_conseils.profession_id')
        ->leftJoin('notaires', 'professions.id', '=', 'notaires.profession_id')
        ->select(
            'professions.*', // Sélectionnez tous les champs de la table professions
            'avocats.specialite_juridique',
            'avocats.barreau',
            'avocats.numero_licence_avocat',
            'architectes.type_projets',
            'architectes.numero_inscription_ordre_architectes',
            'expert_comptables.services_offerts',
            'expert_comptables.numero_agrement',
            'geometres.type_releves',
            'geometres.licence_geometre',
            'coachs.domaine_coaching',
            'coachs.certification_coaching',
            'ingenieurs_conseils.domaine_ingenierie',
            'ingenieurs_conseils.certifications_accreditations',
            'notaires.specialite_notariale',
            'notaires.numero_notaire'
        )
        ->get();

    return view('admin.professionnel', compact('user', 'professionnels'));
}

public function recherche(Request $request)
{
    $user = User::findOrFail(auth()->user()->id);
    $date_debut = $request->input('date_debut');
    $date_fin = $request->input('date_fin');

    // Récupérez les données de toutes les professions avec des jointures
    $professionnels = DB::table('professions')
        ->leftJoin('avocats', 'professions.id', '=', 'avocats.profession_id')
        ->leftJoin('architectes', 'professions.id', '=', 'architectes.profession_id')
        ->leftJoin('expert_comptables', 'professions.id', '=', 'expert_comptables.profession_id')
        ->leftJoin('geometres', 'professions.id', '=', 'geometres.profession_id')
        ->leftJoin('coachs', 'professions.id', '=', 'coachs.profession_id')
        ->leftJoin('ingenieurs_conseils', 'professions.id', '=', 'ingenieurs_conseils.profession_id')
        ->leftJoin('notaires', 'professions.id', '=', 'notaires.profession_id')
        ->select(
            'professions.*', // Sélectionnez tous les champs de la table professions
            'avocats.specialite_juridique',
            'avocats.barreau',
            'avocats.numero_licence_avocat',
            'architectes.type_projets',
            'architectes.numero_inscription_ordre_architectes',
            'expert_comptables.services_offerts',
            'expert_comptables.numero_agrement',
            'geometres.type_releves',
            'geometres.licence_geometre',
            'coachs.domaine_coaching',
            'coachs.certification_coaching',
            'ingenieurs_conseils.domaine_ingenierie',
            'ingenieurs_conseils.certifications_accreditations',
            'notaires.specialite_notariale',
            'notaires.numero_notaire'
        )
        ->whereBetween('professions.created_at', [$date_debut, $date_fin])
        ->get();

    // Passez les résultats filtrés à la vue pour affichage.
    return view('admin.professionnel', compact('user', 'professionnels'));
}



    public function employe(){
        $user = User::findOrFail(auth()->user()->id);
        $users = User::all();
        $roles = Role::all();
        return view('admin.employe', compact('roles','user','users'));
    }

    public function profil(){
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.profil',compact('user'));
    }

    public function update_profil(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);
    
        // ...
    
        // Vérifier si une nouvelle photo de profil a été téléchargée
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('profil'), $photoName);
    
            // Supprimer l'ancienne photo de profil s'il en existe une
            if (!empty($user->photo)) {
                $oldPhotoPath = public_path($user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
    
            $user->photo = 'profil/' . $photoName;
        }
      
        // Mettre à jour les autres informations du notaire
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->telephone = $request->input('telephone');
        $user->sexe = $request->input('sexe');
        $user->email = $request->input('email');
        // Enregistrer les modifications dans la base de données
        $user->save();
    
                Session::flash('success', 'Les informations ont été modifié avec succès');

                return redirect("admin.profil");
    }


    public function changerMotPasse(){
        $user = User::findOrFail(auth()->user()->id);
        return view('admin.changerMotPasse',compact('user'));
    }
    
    public function updatePassword(Request $request){
        $request->validate([
            'Actuel_password' => 'required|min:8|max:100',
            'Nouveau_password' => 'required|min:8|max:100',
            'Confirm_password' => 'required|same:Nouveau_password'
        ]);

        $Actuel_user = auth()->user();

        if(Hash::check($request->Actuel_password,$Actuel_user->password))
        {
            $Actuel_user->update([
                'password' => bcrypt($request->Nouveau_password)
            ]);

            // Stockez le message de succès dans la session
                Session::flash('success', 'Le mot de passe a été modifié avec succès');

                return redirect("admin.changerMotPasse");
           
        }
        else
        {
            // Stockez le message d'erreur dans la session
                Session::flash('error', 'L\'ancien mot de passe ne correspond pas');

                return redirect("admin.changerMotPasse");
        }
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->action = 0;
        $user->save();
        
        Session::flash('success', "L' utilisateur a été activé avec succès.");
        return redirect("admin.employe");
    }
    
    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->action = 1;
        $user->save();

        Session::flash('success', "L' utilisateur a été désactivé avec succès.");
        return redirect("admin.employe");
    }

    public function activate_clients($id)
    {
        $visiteur = Visiteur::findOrFail($id);
        $visiteur->action = 0;
        $visiteur->save();
        
        Session::flash('success', "L' utilisateur a été activé avec succès.");
        return redirect("admin.clients");
    }
    
    public function deactivate_clients($id)
    {
        $visiteur = Visiteur::findOrFail($id);
        $visiteur->action = 1;
        $visiteur->save();

        Session::flash('success', "L' utilisateur a été désactivé avec succès.");
        return redirect("admin.clients");
    }

        public function deactivate_professionnels($id)
    {
        $professionnel = Profession::findOrFail($id);
        $professionnel->action = 0;
        $professionnel->save();

        // Envoyer l'e-mail d'activation du compte au notaire concerné
        Mail::to($professionnel->adresse_email)->send(new DesactiveCompte($professionnel));

        Session::flash('success', "L'utilisateur a été désactivé avec succès.");
        return redirect("admin.professionnel");
    }

    public function activate_professionnels($id)
    {
        $professionnel = Profession::findOrFail($id);
        $professionnel->action = 1;
        $professionnel->save();

        // Envoyer l'e-mail d'activation du compte au notaire concerné
        Mail::to($professionnel->adresse_email)->send(new ActivationCompte($professionnel));

        Session::flash('success', "L'utilisateur a été activé avec succès.");
        return redirect("admin.professionnel");
    }
    public function add_users(Request $request){
        $user = new User;
    
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->sexe = $request->input('sexe');
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach($request->input('role'));
    
        Session::flash('success', "Employé enregistré avec succès.");
        return redirect("admin.employe");
    }

        public function avis(){
            $avis = Info::all();
            $user = User::findOrFail(auth()->user()->id);
            return view('admin.avis',compact('user','avis'));
        }

       // Dans le contrôleur
        public function infos(){
            return view('admin.infos');
        }

  
        public function store(Request $request)
        {
            $request->validate([
                'nom' => 'required',
                'email' => 'required|email',
                'sujet' => 'required',
                'message' => 'required',
            ]);
    
            Info::create([
                'nom' => $request->nom,
                'email' => $request->email,
                'sujet' => $request->sujet,
                'message' => $request->message,
            ]);
    
            return redirect()->back()->with('success', 'Votre message a été envoyé. Merci !');
        }
        

}
