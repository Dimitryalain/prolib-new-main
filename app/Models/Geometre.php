<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geometre extends Model
{
    protected $fillable = [
        'type_releves',
        'licence_geometre',
    ];
    protected $table ="geometres";
    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }
}

