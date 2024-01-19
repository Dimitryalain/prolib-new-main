<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\RDV;

class PDFTDBController extends Controller
{
    public function generePDFDemande(){
        $rdvs = RDV::get();

        $data = [
            'rdvs' => $rdvs, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.demandePDF', $data);

        return $pdf->download('DemandeRDV.pdf');
    }
}
