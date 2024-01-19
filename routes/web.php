<?php

use App\Http\Controllers\BookingControlller;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\HomeController;
use App\Mail\laravelEmail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', HomeController::class);

Route::post('hoursBooking', [BookingControlller::class, 'setHours']);

Route::post('booking', [BookingControlller::class, 'create']);

Route::post('email-laravel', [EmailController::class, 'index']);

Route::get('booking/confirm', function(){
    return 'pagina del booking';
});
