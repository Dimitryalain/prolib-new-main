<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\RDV;

class PDFSuiviController extends Controller
{
    public function generePDFSuivi(){
        $rdvs = RDV::get();

        $data = [
            'rdvs' => $rdvs, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.suiviPDF', $data);

        return $pdf->download('SuiviRDV.pdf');
    }
}
