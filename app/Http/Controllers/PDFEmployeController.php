<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\User;

class PDFEmployeController extends Controller
{
    public function generePDFEmploye(){
        $users = User::get();

        $data = [
            'users' => $users, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.employePDF', $data);

        return $pdf->download('ListeEmployés.pdf');
    }
}
