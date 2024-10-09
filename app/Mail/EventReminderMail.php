<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    /**
     * Create a new message instance.
     *
     * @param $event
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Event Reminder')
                    ->view('emails.event_reminder')
                    ->with('event', $this->event);
    }

    
}
