<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;
    public function __construct($contactData)
    {
        $this->contactData = $contactData;
    }

    public function build()
    {
        $data = $this->contactData;
        return $this->from($data->email)->subject('Conatct Application')->view('Mail.contact', compact('data')); /// from and subject na dile o problem nai 
    }
}
