<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RendezVousRejete extends Mailable
{
    use Queueable, SerializesModels;

    public $professionnel;
    public $heureRendezVous;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professionnel, $heureRendezVous)
    {
        $this->professionnel = $professionnel;
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
            ->view('emails.rendezvous_rejete');
    }
}
