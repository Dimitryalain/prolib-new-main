<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\RDV;
use App\Models\User;
use App\Models\Visiteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Importez la classe Carbon pour travailler avec les dates

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()

    {


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


        $user = User::findOrFail(auth()->user()->id);
        $countRDV = RDV::countRDV();
        $countVisiteur = Visiteur::countVisiteur();
        $CountProfessionnels = Profession::CountProfessionnels();


        // Obtenez l'année en cours
        $currentYear = Carbon::now()->year;
    
        // Obtenez les données des RDV pour l'année en cours
        $rdvData = RDV::getRDVDataForYear($currentYear);
    
        $months = [];
        $counts = [];
    
        // Remplissez le tableau des mois et des compteurs
        for ($month = 1; $month <= 12; $month++) {
            $formattedMonth = $currentYear . '-' . str_pad($month, 2, '0', STR_PAD_LEFT); // Format "YYYY-MM"
            $months[] = $formattedMonth;
    
            $monthData = $rdvData->where('month', $formattedMonth)->first();
    
            if ($monthData) {
                $counts[] = $monthData->count;
            } else {
                $counts[] = 0;
            }
        }
    

        // Récupérez les données des RDV groupées par statut
        $statusCounts = RDV::groupBy('statut')
        ->select('statut', DB::raw('count(*) as count'))
        ->get();


       // Calculer la moyenne des notes des RDV
       $moyenneNotes = DB::table('rdv')->avg('note');

       return view('admin.tdb', compact('user', 'countRDV', 'countVisiteur', 'CountProfessionnels', 'months', 'counts', 'rdvData', 'statusCounts', 'moyenneNotes', 'professions','colors'));
    }
}
}