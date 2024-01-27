<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $appointment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('main@heartteam.uz', 'hearteam')->markdown('mails.app')->with([
            'name' => $this->appointment->name,
            'date' => $this->appointment->date,
            'phone' => $this->appointment->phone,
        ]);
    }
}
