<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Profession extends Authenticatable
{
    // Indiquez les attributs fillable (attributs pouvant être massivement attribués)
    protected $fillable = [
        'nom',
        'prenom',
        'adresse',
        'adresse_email',
        'entreprise_cabinet',
        'site_web',
        'domaine_expertise',
        'date_debut_exercice',
        'education_formation',
        'profession',
        'telephone',
        'password',
        'description',
    ];

    protected $table ="professions";

    public static function CountProfessionnels()
    {
        return DB::table('professions')->count();
    }

    // Définissons les relations avec les professionnels spécifiques
    public function huissiers()
    {
        return $this->hasMany(Huissier::class);
    }

    public function dentistes()
    {
        return $this->hasMany(Dentiste::class);
    }

    public function orthophonistes()
    {
        return $this->hasMany(Orthophoniste::class);
    }


    public function avocats()
    {
        return $this->hasMany(Avocat::class);
    }

    public function architectes()
    {
        return $this->hasMany(Architecte::class);
    }

    public function expertComptables()
    {
        return $this->hasMany(ExpertComptable::class);
    }

    public function geometres()
    {
        return $this->hasMany(Geometre::class);
    }

    public function coachs()
    {
        return $this->hasMany(Coach::class);
    }

    public function ingenieursConseils()
    {
        return $this->hasMany(IngenieurConseil::class);
    }

    public function notaires()
    {
        return $this->hasMany(Notaire::class);
    }

    public function rdv(){
        return $this->hasMany(RDV::class, "profession_id", "id");
    }

    public function emplois(){
        return $this->hasMany(Emploi::class, 'profession_id', 'id');
    }

    public function getPhotoUrlAttribute()
    {
        if (!empty($this->photo)) {
            return asset('storage/photos/' . $this->photo);
        }
        return asset('path/professional_photo.png'); // Remplacez par votre photo par défaut
    }
    

}

