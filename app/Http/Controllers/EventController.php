<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Jobs\SendEventReminderEmail;
use Carbon\Carbon;
class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); 
        return view('index', compact('events'));
    }

    public function create()
    {
       
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string', 
        ]);

        $event = new Event();
        $event->reminder_id = 'REM-' . now()->format('Ymd-His') . '-' . rand(1000, 9999);
        $event->name = $validatedData['name'];
        $event->email = $validatedData['email'];
        $event->event_date = $validatedData['event_date'];
        $event->event_time = $validatedData['event_time'];
        $event->save();
        // $this->scheduleEmail($event);
        return response()->json(['success' => 'Event created successfully']);
    }



    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string', 
        ]);

        $event = Event::findOrFail($id);
        $event->name = $validatedData['name'];
        $event->email = $validatedData['email'];
        $event->event_date = $validatedData['event_date'];
        $event->event_time = $validatedData['event_time'];
        $event->save();

        return response()->json(['success' => 'Event updated successfully']);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['success' => 'Event deleted successfully']);
    }

    public function scheduleEmail($event)
    {

        $recipient = $event->email; 
    
        (new SendEventReminderEmail($event, $recipient))->handle();
    }
    


    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
    
        $file = $request->file('csv_file');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows); 
    
        // Loop through each row and create an event
        foreach ($rows as $row) {
            // Ensure the row has data before creating an event
            if (count($row) == count($header)) {
                $row = array_combine($header, $row);
    
                $event = new Event();
                $event->reminder_id = 'REM-' . time();
                $event->name = $row['name'];
                $event->email = $row['email'];
                $event->event_date = $row['event_date'];
                $event->event_time = $row['event_time'];
                $event->save();
            }
        }
    
        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Events imported successfully.');
    }
    
}
