<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    protected $fillable = [
        'domaine_coaching',
        'certification_coaching',
    ];

    protected $table ="coachs";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

