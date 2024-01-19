<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Professionnel;
use App\Models\RDV;
use App\Models\Visiteur;

class PDFClientsPController extends Controller
{
    public function genereP_PDFClient(){
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
            'visiteurs' => $visiteurs,
        ];

        $pdf = app('dompdf.wrapper')->loadView('professionnel.clientP_PDF', $data);

        return $pdf->download('ListeClients.pdf');
    }
}
