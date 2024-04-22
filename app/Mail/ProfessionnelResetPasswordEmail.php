<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Profession;

class ProfessionnelResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $prenom;
    public $token;

    public function __construct(Profession $professionnel, $token)
    {
        $this->nom = $professionnel->nom;
        $this->prenom = $professionnel->prenom;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('emails.professionnel_reset_password')
                    ->subject('Réinitialisation de mot de passe - Prolib');
    }
}
