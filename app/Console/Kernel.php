<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Event;
use App\Jobs\SendEventReminderEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Check for due reminders every minute
        $schedule->call(function () {
            $this->checkForDueReminders();
        })->everyMinute();

        // Retry failed reminders every minute
        $schedule->call(function () {
            $this->retryFailedReminders();
        })->everyMinute();
    }

    protected function checkForDueReminders()
    {
        Log::info("Checking for due reminders...");
    
        // Check if the device has internet connection
        if ($this->isInternetAvailable()) {
            $now = Carbon::now();
    
            $events = Event::where('is_completed', false)
                ->whereDate('event_date', $now->toDateString())
                ->whereTime('event_time', '>=', $now->toTimeString())
                ->get();
    
            if ($events->isEmpty()) {
                Log::info("No incomplete events found.");
                return;
            }
    
            foreach ($events as $event) {
                Log::info("Sending reminder email for event ID: {$event->id}, email: {$event->email}");
                (new SendEventReminderEmail($event, $event->email))->handle();
                $event->is_completed = true;
                $event->save();
            }
        } else {
            Log::warning("No internet connection. Skipping email reminders.");
        }
    }
    
    protected function isInternetAvailable()
    {
        $url = 'https://www.google.com';
        try {
            $headers = get_headers($url);
            return strpos($headers[0], '200') !== false; 
        } catch (\Exception $e) {
            Log::error("Internet check failed: " . $e->getMessage());
            return false; 
        }
    }
    
    

    // This method would handle retrying failed reminders
    protected function retryFailedReminders()
    {
        // Logic for retrying failed reminders can be added here
    }
}
