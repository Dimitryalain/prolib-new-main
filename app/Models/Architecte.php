<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Architecte extends Model
{
    protected $fillable = [
        'type_projets',
        'numero_inscription_ordre_architectes',
    ];

    protected $table ="architectes";

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

