<?php

use App\Http\Controllers\BookingControlller;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

#Route::post('booking', [BookingControlller::class, 'createBooking']);

Route::post('hoursBooking', [BookingControlller::class, 'setHours']);

Route::post('booking', [BookingControlller::class, 'create']);


Route::get('booking/chooseHour', function($date, $type){
    return 'pagina del booking';
});

Route::get('booking/confirm', function(){
    return 'pagina del booking';
});
