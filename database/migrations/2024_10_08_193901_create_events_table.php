<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('reminder_id')->unique(); // Unique Event Reminder ID
            $table->string('name'); // Event Name
            $table->string('email'); // Email for reminders
            $table->date('event_date'); // Date of the event
            $table->time('event_time')->nullable();
            $table->boolean('is_completed')->default(false); // Tracks if the event is completed
            $table->timestamps(); // Laravel's created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
