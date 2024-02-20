<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RDV;
use App\Models\Visiteur;
use App\Models\Profession;
use App\Models\Emploi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class AuthController extends Controller
{
    public function register(Request $request)
{
    // Validation

    $rules = [
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'telephone' => 'required|string|max:255',
        'date_nais' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:visiteurs', // Utilisez la table 'visiteurs'
        'password' => 'required|string|confirmed|min:8',
        'password_confirmation' => 'required|string', // Assurez-vous d'avoir 'password_confirmation'
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 400);
    }

    $visiteur = Visiteur::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'telephone' => $request->telephone,
        'date_nais' => $request->date_nais,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    $token = $visiteur->createToken('Personal Access Token')->plainTextToken;
    $response = ['visiteur' => $visiteur, 'token' => $token];
    return response()->json($response, 200);
}


public function login(Request $request)
{
    // Validation

    $rules = [
        'email' => 'required|email',
        'password' => 'required|string',
    ];

    $validator = validator($request->all(), $rules);

    if ($validator->fails()) {
        $response = ['message' => 'Veuillez fournir une adresse email et un mot de passe valides'];
        return response()->json($response, 400);
    }

    $visiteur = Visiteur::where('email', $request->email)->first();

    if ($visiteur && Hash::check($request->password, $visiteur->password)) {
        $token = $visiteur->createToken('Personal Access Token')->plainTextToken;
        $response = ['visiteur' => $visiteur, 'token' => $token];
        return response()->json($response, 200);
    }

    $response = ['message' => 'Adresse email ou mot de passe incorrecte'];
    return response()->json($response, 400);
}


public function getUserInfo(Request $request)
    {
        try {
            $visiteur = Auth::guard('web')->user(); // Utilisez le guard 'web' pour les visiteurs

            // Ajoutez votre logique pour formater les données du visiteur selon vos besoins
            $userInfo = [
                'id' => $visiteur->id,
                'nom' => $visiteur->nom,
                'prenom' => $visiteur->prenom,
                'telephone' => $visiteur->telephone,
                'date_naissance' => $visiteur->date_nais,
                'email' => $visiteur->email,
                // Ajoutez d'autres champs selon votre modèle Visiteur
            ];

            return response()->json($userInfo, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load user information'], 500);
        }
    }

    public function updateUserInfo(Request $request)
    {
        try {
            $visiteur = Auth::guard('web')->user(); // Utilisez le guard 'web' pour les visiteurs

            // Ajoutez votre logique pour mettre à jour les informations du visiteur
            $visiteur->nom = $request->input('nom');
            $visiteur->prenom = $request->input('prenom');
            $visiteur->telephone = $request->input('telephone');
            $visiteur->date_nais = $request->input('date_nais');
            // Ajoutez d'autres champs selon votre modèle Visiteur

            $visiteur->save();

            return response()->json(['message' => 'User information updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update user information'], 500);
        }
    }

    public function getHistoriqueRDV(Request $request)
    {
        $visiteurId = $request->user()->id;
    
        $rdvs = RDV::with('profession')->where('visiteur_id', $visiteurId)->get();
    
        return response()->json(['rdvs' => $rdvs], 200);
    }
    

        public function getAccepteRDV(Request $request)
        {
            $visiteurId = $request->user()->id;

            $rdvs = RDV::with('profession')->where('visiteur_id', $visiteurId)
                ->where('statut', '3')
                ->get();

            return response()->json(['rdvs' => $rdvs], 200);
        }

        public function getEnAttenteRDV(Request $request)
        {
            $visiteurId = $request->user()->id;

            $rdvs = RDV::with('profession')->where('visiteur_id', $visiteurId)
                ->where('statut', '0')
                ->get();

            return response()->json(['rdvs' => $rdvs], 200);
        }

        


    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // ... (Ajoutez les autres méthodes comme getUserCount, getProfessionnelCount, getRDVCount, etc.)

    public function getUserCount(Request $request)
    {
        $count = Visiteur::count();

        return response()->json(['count' => $count], 200);
    }

    public function getProfessionnelCount(Request $request)
    {
        $count = Profession::count();

        return response()->json(['countProfessionnel' => $count], 200);
    }

    public function getRDVCount(Request $request)
    {
        $count = RDV::count();

        return response()->json(['countRdv' => $count], 200);
    }
    public function rechercher(Request $request)
{
    $search = $request->input('search');
    $professionFilter = $request->input('profession');

    $query = Profession::leftJoin('emplois', 'professions.id', '=', 'emplois.profession_id')
        ->leftJoin('rdv', 'rdv.profession_id', '=', 'professions.id')
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
            DB::raw('COALESCE(AVG(rdv.note), 0) as moyenne_notes')
        )
        ->whereNotNull('professions.nom')
        ->whereNotNull('professions.adresse')
        ->groupBy('professions.id');

    // Appliquez les filtres de recherche si fournis
    if (!empty($search)) {
        $query->where(function ($innerQuery) use ($search) {
            $innerQuery->where('professions.nom', 'like', '%' . $search . '%')
                ->orWhere('professions.adresse', 'like', '%' . $search . '%')
                ->orWhere('professions.entreprise_cabinet', 'like', '%' . $search . '%');
        });
    }

    if (!empty($professionFilter)) {
        $query->where('professions.profession', $professionFilter);
    }

    try {
        // Exécutez la requête
        $professions = $query->get();

        // Encodez les images en Base64
        foreach ($professions as $profession) {
            $photoFileName = $profession->photo;
            $photoPath = public_path($photoFileName);

            if ($photoPath !== false && is_file($photoPath)) {
                $base64Image = base64_encode(file_get_contents($photoPath));
                $profession->photo_base64 = $base64Image;
                \Log::info('Image encoded: ' . $photoPath);
            } else {
                \Log::error('Image not found or is a directory: ' . $photoPath);
            }
        }

        // Retournez les résultats en tant que réponse JSON
        return response()->json(['professions' => $professions], 200);
    } catch (\Exception $e) {
        // Log de l'exception
        \Log::error('Error in rechercher: ' . $e->getMessage());

        // Retourner une réponse d'erreur
        return response()->json(['error' => 'Erreur lors de la recherche des professions.'], 500);
    }
}


    public function getCreneauxHoraires($professionId)
    {
        try {
            // Log pour vérifier si la route est atteinte et le paramètre professionId
            \Log::info('getCreneauxHoraires called with professionId: ' . $professionId);
    
            // Récupérer le modèle Profession
            $profession = Profession::find($professionId);
    
            if (!$profession) {
                return response()->json(['message' => 'Profession non trouvée.'], 404);
            }
    
            // Récupérer les créneaux horaires via la relation
            $creneauxHoraires = $profession->emplois()->where('statut', '=', 0)->get();
    
            if ($creneauxHoraires->isEmpty()) {
                return response()->json(['message' => 'Aucun créneau horaire disponible.'], 404);
            }
    
            return response()->json(['creneauxHoraires' => $creneauxHoraires], 200);
        } catch (\Exception $e) {
            // Log de l'exception
            \Log::error('Error in getCreneauxHoraires: ' . $e->getMessage());
    
            // Retourner une réponse d'erreur
            return response()->json(['error' => 'Erreur lors de la récupération des créneaux horaires.'], 500);
        }
    }
    

public function getVisiteurs(Request $request)
{
    $visiteurs = Visiteur::all();

    return response()->json(['visiteurs' => $visiteurs], 200);
}

public function createRDV(Request $request)
{
    // Validation des données de requête
    $validator = Validator::make($request->all(), [
        'date_reservation' => 'required|date',
        'date_heure_rdv' => 'required|date',
        'profession_id' => 'required',
        'visiteur_id' => 'required',
        'objet' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    // Création du rendez-vous
    $rdv = RDV::create([
        'date_reservation' => $request->input('date_reservation'),
        'date_heure_rdv' => $request->input('date_heure_rdv'),
        'objet' => $request->input('objet'),
        'profession_id' => $request->input('profession_id'),
        'visiteur_id' => $request->input('visiteur_id'),
    ]);

    // Vérifiez si la création a réussi
    if ($rdv) {
        // Mettre à jour le statut du créneau horaire correspondant
        $emploi = Emploi::where('date_jour', '=', date('Y-m-d', strtotime($request->input('date_heure_rdv'))))
            ->where('profession_id', '=', $request->input('profession_id'))
            ->first();

        if ($emploi) {
            $emploi->statut = 1; // Mettez à jour le statut à 1 pour indiquer qu'il est indisponible
            $emploi->save();
        }

        // Réponse de succès
        return response()->json(['message' => 'Rendez-vous créé avec succès'], 201);
    } else {
        // En cas d'échec de la création
        return response()->json(['message' => 'Erreur lors de la création du rendez-vous'], 500);
    }
}

public function updateCreneauStatus(Request $request)
    {
        $validatedData = $request->validate([
            'profession_id' => 'required',
            'date_jour' => 'required|date',
            'heure_debut' => 'required',
        ]);

        // Recherchez le créneau correspondant dans la table Emploi
        $emploi = Emploi::where('profession_id', $validatedData['profession_id'])
            ->where('date_jour', $validatedData['date_jour'])
            ->where('heure_debut', $validatedData['heure_debut'])
            ->first();

        if ($emploi) {
            // Mettez à jour le statut à 1 pour indiquer qu'il est indisponible
            $emploi->statut = 1;
            $emploi->save();

            return response()->json(['message' => 'Statut du créneau mis à jour avec succès'], 200);
        } else {
            return response()->json(['message' => 'Créneau non trouvé'], 404);
        }
    }

}
