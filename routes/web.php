<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('events', EventController::class);
Route::get('/', [EventController::class, 'index'])->name('home');
Route::post('/events/import', [EventController::class, 'import'])->name('events.import');
Route::get('/api/events', [EventController::class, 'getEvents']);

