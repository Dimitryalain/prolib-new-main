<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emploi extends Model
{

    protected $table = 'emplois';

    protected $fillable = ['heure_debut', 'heure_fin', 'date_jour','statut']; // Attributs pouvant être remplis en masse

    // Règles de validation
    public static $rules = [
        'heure_debut' => 'required',
        'heure_fin' => 'required',
        'date_jour' => 'required',
    ];

    // Messages d'erreur personnalisés pour les règles de validation
    public static $validationMessages = [
        'heure_debut.required' => 'L\'heure de début est requise.',
        'heure_fin.required' => 'L\'heure de fin est requise.',
        'date_jour.required' => 'La date du jour est requise.',
    ];

    use HasFactory;

    public function profession()
{
    return $this->belongsTo(Profession::class, "profession_id", "id");
}


    
}
