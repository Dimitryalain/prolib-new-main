<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orthophoniste extends Model
{
    use HasFactory;

    protected $fillable = [
        'certification',
        'type_patientele',
    ];

    protected $table ="orthophonistes";

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
