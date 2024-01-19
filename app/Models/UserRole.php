<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



// Importe le modèle User
use App\Models\User;

class UserRole extends Model 
{
    use HasFactory;
    protected $table = 'users_roles';

    // Déclare la relation de clé étrangère vers la table users
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
