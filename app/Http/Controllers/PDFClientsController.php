<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Visiteur;

class PDFClientsController extends Controller
{
    public function generePDFClient(){
        $visiteurs = Visiteur::get();

        $data = [
            'visiteurs' => $visiteurs, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.clientPDF', $data);

        return $pdf->download('ListeClients.pdf');
    }
}
