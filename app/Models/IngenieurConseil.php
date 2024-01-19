<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngenieurConseil extends Model
{
    protected $fillable = [
        'domaine_ingenierie',
        'certifications_accreditations',
    ];
    protected $table ="ingenieurs_conseils";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

