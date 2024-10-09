<?php

namespace App\Jobs;
use App\Mail\EventReminderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
class SendEventReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use InteractsWithQueue, Queueable, SerializesModels;

    public $event;
    public $recipient;

    public function __construct($event, $recipient)
    {
        $this->event = $event;
        $this->recipient = $recipient;
    }

    public function handle()
    {
        Mail::to($this->recipient)->send(new EventReminderMail($this->event));
    }
}
