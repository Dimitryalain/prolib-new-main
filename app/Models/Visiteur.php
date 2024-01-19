<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Visiteur extends Model implements Authenticatable
{
    use AuthenticableTrait;

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'date_nais',
        'password',
        'action',
        'photo',
    ];

    protected $table ="visiteurs";

    
    public static function countVisiteur()
    {
     return DB::table('visiteurs')->count();
    }
    
    public function rdv()
{
    return $this->hasMany(RDV::class, "visiteur_id","id");
}

}
