<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RDV extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'id',  // Ajoutez l'attribut 'id' ici
        'statut',
        'date_reservation',
        'date_heure_rdv',
        'objet',
        'rappel_envoye',
        'profession_id',
        'visiteur_id',
    ];
    

    protected $table ="rdv";

    public static function getRDVDataForYear($year)
    {
        return DB::table('rdv')
            ->select(
                DB::raw("DATE_FORMAT(date_reservation, '%Y-%m') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date_reservation', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public static function getRDVDataForYearAndProfessionnel($year, $profession_id)
    {
        return DB::table('rdv')
            ->select(
                DB::raw("DATE_FORMAT(date_reservation, '%Y-%m') as month"),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('date_reservation', $year)
            ->where('profession_id', $profession_id)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public static function countRDV()
    {
        return DB::table('rdv')->count();
    }

    public static function countRDVenAttente()
    {
        return DB::table('rdv')
                ->where('statut', '=', 0)
                ->count();
    }
    public static function coubtRDVAnnule()
    {
        return DB::table('rdv')
                ->where('statut', '=', 1)
                ->count();
    }
    public static function countRDVRejet()
    {
        return DB::table('rdv')
                ->where('statut', '=', 2)
                ->count();
    }
    public static function countRDVValid()
    {
        return DB::table('rdv')
                ->where('statut', '=', 3)
                ->count();
    }
    public static function coubtRDVHonore()
    {
        return DB::table('rdv')
                ->where('statut', '=', 4)
                ->count();
    }

    // POUR LES NOTAIRES

    public static function countRDVP()
{
    $profession_id = Auth::guard('professionnel')->user()->id;
    return DB::table('rdv')->where('profession_id', $profession_id)->count();
}

    public static function countRDVenAttenteNotaire()
{
    $profession_id = Auth::guard('professionnel')->user()->id;
    return DB::table('rdv')
            ->where('profession_id', '=', $profession_id)
            ->where('statut', '=', 0)
            ->count();
}

public static function countRDVAnnuleNotaire()
{
    $profession_id = Auth::guard('professionnel')->user()->id;
    return DB::table('rdv')
            ->where('profession_id', '=', $profession_id)
            ->where('statut', '=', 1)
            ->count();
}

    public static function countRDVRejetNotaire()
    {
    $profession_id = Auth::guard('professionnel')->user()->id;
    return DB::table('rdv')
            ->where('profession_id', '=', $profession_id)
            ->where('statut', '=', 2)
            ->count();
    }

    public static function countRDVValidNotaire()

    {
        $profession_id = Auth::guard('professionnel')->user()->id;
    return DB::table('rdv')
            ->where('profession_id', '=', $profession_id)
            ->where('statut', '=', 3)
            ->count();
    }

    public static function coubtRDVHonoreNotaire()
    {
        $profession_id = Auth::guard('professionnel')->user()->id;
        return DB::table('rdv')
                ->where('profession_id', '=', $profession_id)
                ->where('statut', '=', 4)
                ->count();
    }

    public function visiteur()
    {
        return $this->belongsTo(Visiteur::class, "visiteur_id","id");
    }
    
        public function profession()
    {
        return $this->belongsTo(Profession::class, "profession_id", "id");
    }

    public function getNoteMoyenneAttribute()
{
    $noteMoyenne = $this->rdvs->avg('note'); // Calcul de la moyenne des notes
    return round($noteMoyenne, 1); // Arrondir à une décimale
}


}
