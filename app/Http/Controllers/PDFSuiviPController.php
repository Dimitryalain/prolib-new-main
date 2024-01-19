<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Profession;
use App\Models\RDV;
use App\Models\Visiteur;

class PDFSuiviPController extends Controller
{
    public function genereP_PDFSuivi(){
        // Obtenez l'ID du professionnel connecté
        $professionnelId = auth('professionnel')->user()->id;

        // Récupérez tous les rendez-vous associés à ce professionnel
        $rdvs = RDV::where('profession_id', $professionnelId)->get();

        // Créez un tableau vide pour stocker les visiteurs
        $visiteurs = [];

        // Parcourez les rendez-vous et récupérez les visiteurs associés
        foreach ($rdvs as $rdv) {
            $visiteur = $rdv->visiteur;
            if ($visiteur) {
                $visiteurs[] = $visiteur;
            }
        }

        // Maintenant, vous avez la liste des visiteurs associés à ce professionnel
        $data = [
            'rdvs' => $rdvs,
        ];

        $pdf = app('dompdf.wrapper')->loadView('professionnel.suiviP_PDF', $data);

        return $pdf->download('SuiviRDV.pdf');
    }
}
