<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use App\Models\Audit;

class PDFAuditController extends Controller
{
    public function generePDFAudit(){
        $audits = Audit::get();

        $data = [
            'audits' => $audits, // Ici, nous incluons tous les utilisateurs avec leurs rôles
        ];

        $pdf = app('dompdf.wrapper')->loadView('admin.auditPDF', $data);

        return $pdf->download('Audit.pdf');
    }
}
