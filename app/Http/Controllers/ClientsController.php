<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\RDV;
use App\Models\Visiteur;
use App\Models\Emploi;
use App\Models\SearchStatistic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ClientsController extends Controller
{
    public function rechercher(Request $request)
{
    $search = $request->input('search');
    $professionFilter = $request->input('profession');

    if (empty($search) && empty($professionFilter)) {
        return view('welcome');
    }

    $professions = Profession::leftjoin('emplois', 'professions.id', '=', 'emplois.profession_id')
        ->select(
            'professions.id',
            'professions.nom',
            'professions.prenom',
            'professions.adresse_email',
            'professions.entreprise_cabinet',
            'professions.site_web',
            'professions.domaine_expertise',
            'professions.date_debut_exercice',
            'professions.education_formation',
            'professions.profession',
            'professions.telephone',
            'professions.description',
            'professions.photo',
            DB::raw('(SELECT COALESCE(AVG(rdv.note), 0) FROM rdv WHERE rdv.profession_id = professions.id) as moyenne_notes')
        )
        ->when($search, function ($query) use ($search) {
            return $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('professions.nom', 'like', '%' . $search . '%')
                    ->orWhere('professions.adresse', 'like', '%' . $search . '%')
                    ->orWhere('professions.entreprise_cabinet', 'like', '%' . $search . '%');
            });
        })
        ->when($professionFilter, function ($query) use ($professionFilter) {
            return $query->where('professions.profession', '=', $professionFilter);
        })
        ->whereNotNull('professions.nom')
        ->whereNotNull('professions.adresse')
        ->groupBy(
            'professions.id',
            'professions.nom',
            'professions.prenom',
            'professions.adresse_email',
            'professions.entreprise_cabinet',
            'professions.site_web',
            'professions.domaine_expertise',
            'professions.date_debut_exercice',
            'professions.education_formation',
            'professions.profession',
            'professions.telephone',
            'professions.description',
            'professions.photo'
        )
        ->get()
->each(function ($profession) {
    $profession->emplois->each(function ($emploi) {
        $emploi->indisponible = $emploi->statut == 1;
    });
})
->values();


if ($professions->isEmpty()) {
    $searchStatistic = SearchStatistic::firstOrNew();
    $searchStatistic->search_count++;
    $searchStatistic->save();

    return view('recherche-professionel', compact('professions', 'professionFilter', 'search'))
        ->with('error', 'Aucun résultat trouvé.');
}

$searchStatistic = SearchStatistic::firstOrNew();
$searchStatistic->search_count++;
$searchStatistic->save();

    return view('recherche-professionel', compact('professions', 'professionFilter', 'search'));
}

    

    public function booking($notaireId, Request $request)
    {
        $profession = Profession::findOrFail($notaireId);
        $date = $request->input('date');
        $heureDebut = $request->input('heureDebut');
    
        return view("visiteur.booking", compact('profession', 'date', 'heureDebut'));
    }

    public function detail($notaireId)
{
    $profession = Profession::findOrFail($notaireId);
    $visiteurs = Visiteur::all();

    $date = request()->query('date');
    $heureDebut = request()->query('heureDebut');

    $date_heure_rdv = $date . ' ' . $heureDebut;

    return view("visiteur.detail", compact('profession', 'visiteurs', 'date_heure_rdv'));
}


public function saveRdv(Request $request)
{
    // Validation des données du formulaire
    $validatedData = $request->validate([
        'date_reservation' => 'required|date',
        'date_heure_rdv' => 'required|date',
        'profession_id' => 'required',
        'visiteur_id' => 'required',
        'objet' => 'required',
    ]);

    // Enregistrement des données dans la table "rdv"
    $rdv = new RDV();
    $rdv->date_reservation = $validatedData['date_reservation'];
    $rdv->date_heure_rdv = $validatedData['date_heure_rdv'];
    $rdv->profession_id = $validatedData['profession_id'];
    $rdv->visiteur_id = $validatedData['visiteur_id'];
    $rdv->objet = $validatedData['objet'];
    $rdv->save();

    // Mettre à jour le statut du créneau horaire correspondant
    $emploi = Emploi::where('date_jour', '=', date('Y-m-d', strtotime($validatedData['date_heure_rdv'])))
        ->where('profession_id', '=', $validatedData['profession_id'])
        ->first();

    if ($emploi) {
        $emploi->statut = 1; // Mettez à jour le statut à 1 pour indiquer qu'il est indisponible
        $emploi->save();
    }

    // Message de succès avec SweetAlert2
    return redirect()->back()->with('success', 'Votre rendez-vous a été enregistré avec succès.');
}




public function profilV()
{
    $visiteur = Visiteur::findOrFail(auth()->guard('visiteur')->user()->id);
    return view("visiteur.profilV", compact('visiteur'));
}


public function update_profil_visiteur(Request $request)
{
    $visiteur = Visiteur::findOrFail(auth()->guard('visiteur')->user()->id);

    // Mettre à jour les autres informations du notaire
    $visiteur->nom = $request->input('nom');
    $visiteur->prenom = $request->input('prenom');
    $visiteur->telephone = $request->input('telephone');
    $visiteur->date_nais = $request->input('date');
    $visiteur->email = $request->input('email');
    // Enregistrer les modifications dans la base de données
    $visiteur->save();

    return redirect()->back()->with('success', 'Votre profil a été mis à jour avec succès.');
}


public function RdvAccepte()
{
    // Récupérer l'identifiant du visiteur connecté
    $visiteurId = Auth::guard('visiteur')->user()->id;
    $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);

    // Récupérer tous les rendez-vous du visiteur ayant le statut "accepté"
    $rdvs = RDV::where('visiteur_id', $visiteurId)
                                  ->where('statut', '3')
                                  ->paginate(5);
    // Passer les rendez-vous à la vue
    return view("visiteur.RdvAccepte", compact('rdvs','visiteur'));
}


public function RdvClient()
{
    return view("visiteur.RdvClient");
}

public function RdvEnAttente()
{
    // Récupérer l'identifiant du visiteur connecté
    $visiteurId = Auth::guard('visiteur')->user()->id;
    $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);

    // Récupérer tous les rendez-vous du visiteur ayant le statut "accepté"
    $rdvs = RDV::where('visiteur_id', $visiteurId)
                                  ->where('statut', '0')
                                  ->get();
    // Passer les rendez-vous à la vue

    return view("visiteur.RdvEnAttente", compact('rdvs','visiteur'));
}

public function Historique()
{
    $visiteurId = Auth::guard('visiteur')->user()->id;
    $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);

    // Ajoutez get() à la fin pour exécuter la requête et obtenir les résultats
    $rdvs = RDV::where('visiteur_id', $visiteurId)->get();
   
    return view("visiteur.Historique", compact('rdvs','visiteur'));
}


public function changerMotPasseV(){
    $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);
    return view('visiteur.changerMotPasseV', compact('visiteur'));
}


    public function update_profilV(Request $request)
    {
        $visiteur = Visiteur::findOrFail(auth('visiteur')->user()->id);
    
        // Vérifier si une nouvelle photo de profil a été téléchargée
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('profil'), $photoName);
    
            // Supprimer l'ancienne photo de profil s'il en existe une
            if (!empty($user->photo)) {
                $oldPhotoPath = public_path($visiteur->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
    
            $visiteur->photo = 'profil/' . $photoName;
        }
      
        // Mettre à jour les autres informations du notaire
        $visiteur->nom = $request->input('nom');
        $visiteur->prenom = $request->input('prenom');
        $visiteur->telephone = $request->input('telephone');
       
        $visiteur->email = $request->input('email');
        // Enregistrer les modifications dans la base de données
        $visiteur->save();
    
                Session::flash('success', 'Les informations ont été modifié avec succès');

                return redirect("visiteur.profilV");
    }


}
