<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avocat extends Model
{
    protected $fillable = [
        'specialite_juridique',
        'barreau',
        'numero_licence_avocat',
    ];
    protected $table ="avocats";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

