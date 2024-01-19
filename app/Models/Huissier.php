<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huissier extends Model
{
    use HasFactory;

    protected $fillable = [
        'num_conseil',
        'tribunal',
    ];

    protected $table ="huissiers";

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}
