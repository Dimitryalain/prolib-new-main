<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentiste extends Model
{
    use HasFactory;

    protected $fillable = [
        'licence',
        'annees_etudes',
    ];

    protected $table ="dentistes";

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
