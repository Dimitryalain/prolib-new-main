<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notaire extends Model
{
    protected $fillable = [
        'specialite_notariale',
        'numero_notaire',
    ];
    protected $table ="notaires";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

