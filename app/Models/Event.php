<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'reminder_id',
        'name',
        'email',
        'event_date',
        'event_time',
        'is_completed',
        
    ];

}
