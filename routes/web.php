<?php

use App\Http\Controllers\ApptsNoSignController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LoginHomeController;
use App\Http\Controllers\AuthController;
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


Route::group(['middleware' => 'guest'], function () {

    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    
});


Route::group(['middleware' => 'auth'], function () {
   
    Route::get('loginHome', [LoginHomeController::class, 'index']);
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::post('apptcreate', [ApptsNoSignController::class, 'create'])->name('apptcreate');
    Route::post('setHoursBooking', [ApptsNoSignController::class, 'setHours'])->name('setHoursBooking');
    Route::post('confirmAppt', [ApptsNoSignController::class, 'confirmData'])->name('confirmAppt');
    Route::post('saveAppts', [ApptsNoSignController::class, 'saveAppts'])->name('saveAppts');
    Route::post('confirmRemove', [ApptsNoSignController::class, 'confirmRemove'])->name('confirmRemove');
    Route::post('removeAppts', [ApptsNoSignController::class, 'removeAppts'])->name('removeAppts');
    Route::post('editData', [ApptsNoSignController::class, 'editData'])->name('editData');
    Route::post('updateAppts', [ApptsNoSignController::class, 'updateAppts'])->name('updateAppts');
    #Route::get('/login', function() { return view('loginHome'); })->name('login');
    #Route::get('/register', function() { return view('loginHome'); })->name('register');
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    
});
