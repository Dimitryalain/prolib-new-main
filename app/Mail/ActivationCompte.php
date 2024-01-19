<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationCompte extends Mailable
{
    use Queueable, SerializesModels;

    public $professionnel;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($professionnel)
    {
        $this->professionnel = $professionnel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Profession libérale')
            ->view('emails.compte_active');
    }
}
