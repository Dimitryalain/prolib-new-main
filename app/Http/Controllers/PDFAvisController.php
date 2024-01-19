<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Info;

class PDFAvisController extends Controller
{
    public function generePDFEmploye(){
        $avis = Info::get();

        $data = [
            'avis' => $avis, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.avisPDF', $data);

        return $pdf->download('ListeAvis.pdf');
    }
}
