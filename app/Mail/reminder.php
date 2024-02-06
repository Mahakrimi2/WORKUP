<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reminder extends Mailable
{

    use Queueable, SerializesModels;
    public $salle;
    public $date;
    public $time_start;
    public $time_end;

    /**
     * Create a new message instance.
     */
    public function __construct($salle,$date,$time_start,$time_end)
    {
        $this->salle=$salle;
        $this->date=$date;
        $this->time_start=$time_start;
        $this->time_end=$time_end;
    }



    public function build()
    {
        return $this->subject('Mail from workup')

        ->view('emails.reminder');

    
    }
}
