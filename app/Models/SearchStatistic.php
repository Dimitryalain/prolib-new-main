<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchStatistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_count',
    ];
}
