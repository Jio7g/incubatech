<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IncubationShareMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $shareUrl;

    public function __construct($client, $shareUrl)
    {
        $this->client = $client;
        $this->shareUrl = $shareUrl;
    }

    public function build()
    {
        return $this->view('emails.incubation_share')
                    ->subject('Información de incubación compartida');
    }
}
