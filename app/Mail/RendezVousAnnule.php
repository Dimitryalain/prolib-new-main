<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RendezVousAnnule extends Mailable
{
    use Queueable, SerializesModels;

    public $professionnel;
    public $visiteur;
    public $heureRendezVous;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professionnel, $visiteur, $heureRendezVous)
    {
        $this->professionnel = $professionnel;
        $this->visiteur = $visiteur;
        $this->heureRendezVous = $heureRendezVous;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Profession libérale')
            ->view('emails.rendezvous_annule');
    }
}
