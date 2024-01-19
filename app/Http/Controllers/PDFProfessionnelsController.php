<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Profession;

class PDFProfessionnelsController extends Controller
{
    public function generePDFProfessionnel(){
        $Professions = Profession::get();

        $data = [
            'Professions' => $Professions, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.professionnelPDF', $data);

        return $pdf->download('ListeProfessionnels.pdf');
    }
}
