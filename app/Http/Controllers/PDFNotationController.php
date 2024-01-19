<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\RDV;

class PDFNotationController extends Controller
{
    public function generePDFNotation()
    {
        // Charger les rendez-vous avec les professionnels associés et leurs moyennes de notes
        $rdvs = RDV::with(['profession' => function ($query) {
            $query->withAvg('rdv', 'note');
        }])->get();

        $data = [
            'rdvs' => $rdvs,
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.notationsPDF', $data);

        return $pdf->download('NotationsPDF.pdf');
    }
}

