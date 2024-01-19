<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpertComptable extends Model
{
    protected $fillable = [
        'services_offerts',
        'numero_agrement',
    ];

    protected $table ="expert_comptables";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

