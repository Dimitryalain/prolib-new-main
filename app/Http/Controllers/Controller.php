<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Visiteur;
use App\Models\RDV;
use App\Models\Profession;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function contact(){
        return view('contact');
    }

    public function welcome(){

    $CountProfessionnels = Profession::CountProfessionnels();
    $countRDV = RDV::countRDV();
    $countVisiteur = Visiteur::countVisiteur();
        return view('welcome', compact('CountProfessionnels','countRDV','countVisiteur'));
    }
}
