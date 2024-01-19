<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RendezVousHonore extends Mailable
{
    use Queueable, SerializesModels;

    public $professionnel;
    public $visiteur;
    public $heureRendezVous;
    public $rendezvousId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professionnel, $visiteur, $heureRendezVous, $rendezvousId)
{
    $this->professionnel = $professionnel;
    $this->visiteur = $visiteur;
    $this->heureRendezVous = $heureRendezVous;
    $this->rendezvousId = $rendezvousId; // Ajout de la variable $rendezvousId
}


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Profession libérale')
            ->view('emails.rendezvous_honore');
    }

}
