<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\RDV;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Emploi;
use App\Models\Avocat;
use App\Models\Architecte;
use App\Models\ExpertComptable;
use App\Models\Geometre;
use App\Models\Coach;
use App\Models\IngenieurConseil;
use App\Models\Notaire;
use App\Models\Dentiste;
use App\Models\Huissier;
use App\Models\Orthophoniste;
use Illuminate\Support\Facades\Mail;
use App\Mail\RendezVousAccepte;
use App\Mail\RendezVousRejete;
use App\Mail\RendezVousHonore;
use App\Mail\RendezVousAnnule;

class ProfessionelController extends Controller
{
        public function professionnels(){
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
        $year = date('Y');
        $profession_id = Auth::guard('professionnel')->user()->id;

        // Obtenir la moyenne des notes par rendez-vous pour ce professionnel
        $moyenneNotesParProfessionnel = RDV::select('profession_id', DB::raw('AVG(note) as moyenne_notes'))
            ->whereYear("date_reservation", $year)
            ->where("profession_id", $profession_id)
            ->groupBy('profession_id')
            ->first();

        $nombreVisiteursParProfessionnel = RDV::whereYear("date_reservation", $year)
            ->where("profession_id", $profession_id)
            ->count();

        $statusCounts = RDV::whereYear("date_reservation", $year)
            ->where("profession_id", $profession_id)
            ->groupBy('statut', 'profession_id')
            ->select('profession_id', 'statut', DB::raw('count(*) as count'))
            ->get();

        // Bloc pour le nombre de rendez-vous par mois pour tous les professionnels
        $currentYear = Carbon::now()->year;
        $rdvDataAllProfessionals = RDV::getRDVDataForYear($currentYear);

        $monthsAllProfessionals = [];
        $countsAllProfessionals = [];

        for ($month = 1; $month <= 12; $month++) {
            $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            $monthsAllProfessionals[] = $formattedMonth;

            $monthData = $rdvDataAllProfessionals->where('month', $formattedMonth)->first();

            if ($monthData) {
                $countsAllProfessionals[] = $monthData->count;
            } else {
                $countsAllProfessionals[] = 0;
            }
        }

        // Bloc pour le nombre de rendez-vous par mois pour un professionnel spécifique
        $rdvDataForProfessional = RDV::getRDVDataForYearAndProfessionnel($currentYear, $profession_id);

        $monthsForProfessional = [];
        $countsForProfessional = [];

        for ($month = 1; $month <= 12; $month++) {
            $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT);
            $monthsForProfessional[] = $formattedMonth;

            $monthData = $rdvDataForProfessional->where('month', $formattedMonth)->first();

            if ($monthData) {
                $countsForProfessional[] = $monthData->count;
            } else {
                $countsForProfessional[] = 0;
            }
        }

        $countRDVenAttenteNotaire = RDV::countRDVenAttenteNotaire();
        $countRDVRejetNotaire = RDV::countRDVRejetNotaire();
        $countRDVValidNotaire = RDV::countRDVValidNotaire();
        $coubtRDVHonoreNotaire = RDV::coubtRDVHonoreNotaire();
        $countRDVAnnuleNotaire = RDV::countRDVAnnuleNotaire();
        $countRDVP = RDV::countRDVP();

        return view("professionnels", [
            'countRDVenAttenteNotaire' => $countRDVenAttenteNotaire,
            'countRDVRejetNotaire' => $countRDVRejetNotaire,
            'countRDVValidNotaire' => $countRDVValidNotaire,
            'coubtRDVHonoreNotaire' => $coubtRDVHonoreNotaire,
            'countRDVAnnuleNotaire' => $countRDVAnnuleNotaire,
            'professionnel' => $professionnel,
            'countRDVP' => $countRDVP,
            'moyenneNotesParProfessionnel' => $moyenneNotesParProfessionnel,
            'nombreVisiteursParProfessionnel' => $nombreVisiteursParProfessionnel,
            'statusCounts' => $statusCounts,
            'monthsAllProfessionals' => $monthsAllProfessionals,
            'countsAllProfessionals' => $countsAllProfessionals,
            'monthsForProfessional' => $monthsForProfessional,
            'countsForProfessional' => $countsForProfessional,
        ]);
        
    }

    
    public function changerMotPasseP(){
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
        return view('professionnel.changerMotPasseP', compact('professionnel'));
    }
    
    public function updatePasswordP(Request $request){
        $request->validate([
            'Actuel_password' => 'required|min:8|max:100',
            'Nouveau_password' => 'required|min:8|max:100',
            'Confirm_password' => 'required|same:Nouveau_password'
        ]);

        $Actuel_user = auth('professionnel')->user();

        if(Hash::check($request->Actuel_password,$Actuel_user->password))
        {
            $Actuel_user->update([
                'password' => bcrypt($request->Nouveau_password)
            ]);

            // Stockez le message de succès dans la session
                Session::flash('success', 'Le mot de passe a été modifié avec succès');

                return redirect("professionnel.changerMotPasseP");
           
        }
        else
        {
            // Stockez le message d'erreur dans la session
                Session::flash('error', 'L\'ancien mot de passe ne correspond pas');

                return redirect("professionnel.changerMotPasseP");
        }
    }

    public function profilP(){
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
        return view('professionnel.profilP',compact('professionnel'));
    }

    public function paiementP(){
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
        return view('professionnel.paiementP',compact('professionnel'));
    }

    public function planifieP(){
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
    
        // Récupérer les emplois du notaire pour la date sélectionnée
        $emplois = Emploi::where('profession_id', $professionnel->id)
            ->get()
            ->sortBy('heure_debut');
    
        return view('professionnel.planifieP', compact('professionnel', 'emplois'));
    }
    

    public function sauvegarderEmploi(Request $request)
{
    // Récupérer l'ID du professionnel connecté
    $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);

    // Récupérer les données du formulaire
    $heureDebut = $request->input('heure_debut');
    $heureFin = $request->input('heure_fin');
    $dateSelectionnee = $request->input('date_jour');

    // Vérifier si une emploi avec des heures qui se chevauchent existe déjà pour la même journée
    $existingEmploi = Emploi::where('profession_id', $professionnel->id)
        ->where('date_jour', $dateSelectionnee)
        ->where(function ($query) use ($heureDebut, $heureFin) {
            $query->where(function ($query) use ($heureDebut, $heureFin) {
                $query->where('heure_debut', '<=', $heureDebut)
                    ->where('heure_fin', '>=', $heureDebut);
            })->orWhere(function ($query) use ($heureDebut, $heureFin) {
                $query->where('heure_debut', '<=', $heureFin)
                    ->where('heure_fin', '>=', $heureFin);
            });
        })
        ->first();

    if ($existingEmploi) {
        // Une emploi avec des heures qui se chevauchent existe déjà
        // Retourner une réponse d'erreur ou effectuer une action appropriée
        return redirect()->back()->with('error', 'Une emploi avec des heures qui se chevauchent existe déjà pour cette journée.');
    }

    // Créer un nouvel objet Emploi et définir les valeurs
    $emploi = new Emploi();
    $emploi->heure_debut = $heureDebut;
    $emploi->heure_fin = $heureFin;
    $emploi->date_jour = $dateSelectionnee;
    $emploi->profession_id = $professionnel->id; // Associer l'emploi au professionnel connecté

    // Effectuer la logique de sauvegarde en base de données
    $emploi->save();

    // Retourner une réponse de succès
    return redirect()->back()->with('success', 'Emploi sauvegardé avec succès.');
}


     public function update_profilP(Request $request)
    {
                $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
            
                // Vérifier si une nouvelle photo de profil a été téléchargée
                if ($request->hasFile('photo')) {
                    $photo = $request->file('photo');
                    $photoName = time() . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('profil'), $photoName);
            
                    // Supprimer l'ancienne photo de profil s'il en existe une
                    if (!empty($professionnel->photo)) {
                        $oldPhotoPath = public_path($professionnel->photo);
                        if (file_exists($oldPhotoPath)) {
                            unlink($oldPhotoPath);
                        }
                    }
            
                    $professionnel->photo = 'profil/' . $photoName;
                }
            
                // Mettre à jour les autres informations du notaire
                $professionnel->nom = $request->input('nom');
                $professionnel->prenom = $request->input('prenom');
                $professionnel->adresse = $request->input('adresse');
                $professionnel->adresse_email = $request->input('adresse_email');
                $professionnel->entreprise_cabinet = $request->input('entreprise_cabinet');
                $professionnel->site_web = $request->input('site_web');
                $professionnel->domaine_expertise = $request->input('domaine_expertise');
                $professionnel->date_debut_exercice = $request->input('date_debut_exercice');
                $professionnel->education_formation = $request->input('education_formation');
                $professionnel->profession = $request->input('profession');
                $professionnel->telephone = $request->input('telephone');
                $professionnel->description = $request->input('description');
                // Enregistrer les modifications dans la base de données
                $professionnel->save();
            

                if (Auth::guard('professionnel')->user()->profession == 'Avocat') {
                    $avocat = Avocat::where('profession_id', $professionnel->id)->first();
                    if (!$avocat) {
                        $avocat = new Avocat();
                        $avocat->profession_id = $professionnel->id;
                    }
                    $avocat->specialite_juridique = $request->input('specialite_juridique');
                    $avocat->barreau = $request->input('barreau');
                    $avocat->numero_licence_avocat = $request->input('numero_licence_avocat');
                    $avocat->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Architecte') {
                    $architecte = Architecte::where('profession_id', $professionnel->id)->first();
                    if (!$architecte) {
                        $architecte = new Architecte();
                        $architecte->profession_id = $professionnel->id;
                    }
                    $architecte->type_projets = $request->input('type_projets');
                    $architecte->numero_inscription_ordre_architectes = $request->input('numero_inscription_ordre_architectes');
                    $architecte->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Expert Comptable') {
                    $expertComptable = ExpertComptable::where('profession_id', $professionnel->id)->first();
                    if (!$expertComptable) {
                        $expertComptable = new ExpertComptable();
                        $expertComptable->profession_id = $professionnel->id;
                    }
                    $expertComptable->services_offerts = $request->input('services_offerts');
                    $expertComptable->numero_agrement = $request->input('numero_agrement');
                    $expertComptable->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Géomètre') {
                    $geometre = Geometre::where('profession_id', $professionnel->id)->first();
                    if (!$geometre) {
                        $geometre = new Geometre();
                        $geometre->profession_id = $professionnel->id;
                    }
                    $geometre->type_releves = $request->input('type_releves');
                    $geometre->licence_geometre = $request->input('licence_geometre');
                    $geometre->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Dentiste') {
                    $dentiste = Dentiste::where('profession_id', $professionnel->id)->first();
                    if (!$dentiste) {
                        $dentiste = new Dentiste();
                        $dentiste->profession_id = $professionnel->id;
                    }
                    $dentiste->licence = $request->input('licence');
                    $dentiste->annees_etudes = $request->input('annees_etudes');
                    $dentiste->save();
                }
                elseif (Auth::guard('professionnel')->user()->profession == 'Huissier') {
                $huissier = Huissier::where('profession_id', $professionnel->id)->first();
                if (!$huissier) {
                    $huissier = new Huissier();
                    $huissier->profession_id = $professionnel->id;
                }
                $huissier->num_conseil = $request->input('num_conseil');
                $huissier->tribunal = $request->input('tribunal');
                $huissier->save();
                }
                elseif (Auth::guard('professionnel')->user()->profession == 'Orthophoniste') {
                    $orthophoniste = Orthophoniste::where('profession_id', $professionnel->id)->first();
                    if (!$orthophoniste) {
                        $orthophoniste = new Orthophoniste();
                        $orthophoniste->profession_id = $professionnel->id;
                    }
                    $orthophoniste->certification = $request->input('certification');
                    $orthophoniste->type_patientele = $request->input('type_patientele');
                    $orthophoniste->save();
                    }
                 elseif (Auth::guard('professionnel')->user()->profession == 'Coach') {
                    $coach = Coach::where('profession_id', $professionnel->id)->first();
                    if (!$coach) {
                        $coach = new Coach();
                        $coach->profession_id = $professionnel->id;
                    }
                    $coach->domaine_coaching = $request->input('domaine_coaching');
                    $coach->certification_coaching = $request->input('certification_coaching');
                    $coach->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Ingenieur Conseil') {
                    $ingenieurConseil = IngenieurConseil::where('profession_id', $professionnel->id)->first();
                    if (!$ingenieurConseil) {
                        $ingenieurConseil = new IngenieurConseil();
                        $ingenieurConseil->profession_id = $professionnel->id;
                    }
                    $ingenieurConseil->domaine_ingenierie = $request->input('domaine_ingenierie');
                    $ingenieurConseil->certifications_accreditations = $request->input('certifications_accreditations');
                    $ingenieurConseil->save();
                } elseif (Auth::guard('professionnel')->user()->profession == 'Notaire') {
                    $notaire = Notaire::where('profession_id', $professionnel->id)->first();
                    if (!$notaire) {
                        $notaire = new Notaire();
                        $notaire->profession_id = $professionnel->id;
                    }
                    $notaire->specialite_notariale = $request->input('specialite_notariale');
                    $notaire->numero_notaire = $request->input('numero_notaire');
                    $notaire->save();
                }
                
            // Enregistrer les modifications dans la base de données
            $professionnel->save();

        Session::flash('success', 'Les informations ont été modifié avec succès');

        return redirect("professionnel.profilP");
    }

    public function clientsP() {
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
    
        // Vous devez exécuter une requête pour obtenir les visiteurs associés à ce professionnel
        $rdvs = RDV::where('profession_id', $professionnel->id)
                    ->with('visiteur')
                    ->get(); // Utilisez get() pour récupérer les résultats
    
        return view('professionnel.clientsP', compact('professionnel', 'rdvs'));
    }

    public function suiviP() {
        $professionnel = Profession::findOrFail(auth('professionnel')->user()->id);
    
        // Vous devez exécuter une requête pour obtenir les visiteurs associés à ce professionnel
        $rdvs = RDV::where('profession_id', $professionnel->id)
                    ->with('visiteur')
                    ->get(); // Utilisez get() pour récupérer les résultats
    
        return view('professionnel.suiviP', compact('professionnel', 'rdvs'));
    }

    public function rejeterRendezVous(Request $request, $id)
    {
        $rendezvous = RDV::findOrFail($id);
        $rendezvous->statut = 1; // Accepté
        $rendezvous->save();

        // Récupérez le visiteur concerné
        $visiteur = Visiteur::findOrFail($rendezvous->visiteur_id);

        // Récupérez le professionnel associé au rendez-vous
        $professionnel = Profession::findOrFail($rendezvous->profession_id);

        // Envoyer l'e-mail au visiteur concerné avec les informations nécessaires
        Mail::to($visiteur->email)->send(new RendezVousRejete($professionnel->nom, $rendezvous->date_heure_rdv));

        return redirect()->back()->with('success', 'Statut du rendez-vous mis à jour avec succès');
    }
        
    
    public function accepterRendezVous($id)
    {
        // Récupérez le rendez-vous
        $rendezvous = RDV::findOrFail($id);
    
        // Assurez-vous que le rendez-vous a le statut 0
        if ($rendezvous->statut !== 0) {
            return redirect()->back()->with('error', 'Le statut du rendez-vous ne peut pas être mis à jour.');
        }
    
        // Définir le statut du rendez-vous à "Accepté" (3)
        $rendezvous->statut = 3;
        $rendezvous->save();
    
        // Récupérez le visiteur concerné
        $visiteur = Visiteur::findOrFail($rendezvous->visiteur_id);
    
        // Récupérez le notaire associé au rendez-vous
        $professionnel = Profession::findOrFail($rendezvous->profession_id);
    
        // Assurez-vous que le professionnel est trouvé
        if (!$professionnel) {
            return redirect()->back()->with('error', 'Le professionnel associé au rendez-vous n\'a pas été trouvé.');
        }
    
        // Envoyer l'e-mail d'acceptation au visiteur concerné avec les informations nécessaires
        Mail::to($visiteur->email)->send(new RendezVousAccepte($professionnel, $rendezvous->date_heure_rdv));
    
        return redirect()->back()->with('success', 'Statut du rendez-vous mis à jour avec succès');
    }
    
    
    public function annulerRendezVous(Request $request, $id)
    {
        $rendezvous = RDV::findOrFail($id);
        $rendezvous->statut = 2; // Annulé
        $rendezvous->save();

        // Récupérez le visiteur concerné
        $visiteur = Visiteur::findOrFail($rendezvous->visiteur_id);

        // Récupérez le notaire associé au rendez-vous
        $professionnel = Profession::findOrFail($rendezvous->profession_id);

        // Envoyer l'e-mail au visiteur concerné avec les informations nécessaires
        Mail::to($visiteur->email)->send(new RendezVousAnnule($professionnel->nom, $visiteur->nom, $rendezvous->date_heure_rdv));

        // Envoyer l'e-mail au notaire concerné avec les informations nécessaires
        Mail::to($professionnel->adresse_email)->send(new RendezVousAnnule($professionnel->nom, $visiteur->nom, $rendezvous->date_heure_rdv));

        return redirect()->back()->with('success', 'Statut du rendez-vous mis à jour avec succès');
    }
    
    
    public function honorerRendezVous(Request $request, $id)
    {
        $rendezvous = RDV::findOrFail($id);
        $rendezvous->statut = 4; // Honoré
        $rendezvous->save();

        // Récupérez le visiteur concerné
        $visiteur = Visiteur::findOrFail($rendezvous->visiteur_id);

        // Récupérez le notaire associé au rendez-vous
        $professionnel = Profession::findOrFail($rendezvous->profession_id);

        // Envoyer l'e-mail au visiteur concerné avec les informations nécessaires
        Mail::to($visiteur->email)->send(new RendezVousHonore($professionnel->nom, $visiteur->nom, $rendezvous->date_heure_rdv, $rendezvous->id));

        return redirect()->back()->with('success', 'Statut du rendez-vous mis à jour avec succès');
    }
    
    
}
