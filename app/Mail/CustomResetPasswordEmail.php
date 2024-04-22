<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visiteur;

class CustomResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $prenom;
    public $token;

    public function __construct(Visiteur $visiteur, $token)
    {
        $this->nom = $visiteur->nom;
        $this->prenom = $visiteur->prenom;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('emails.custom_reset_password')
                    ->subject('Réinitialisation de mot de passe - Prolib');
    }
}
