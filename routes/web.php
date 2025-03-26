<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/register','user.forms.register');
Route::post('/user-registration', [Usercontroller::class,'register'])->name('register');

Route::view('/login','user.forms.login')->name('login');
Route::post('/user-login',[UserController::class,'login'])->name('user.login');



Route::view('/dashboard','user.auth.dashboard')->middleware('auth');

Route::post('/logout',[UserController::class,'logout']);

Route::view('/admin','admin.adminLogin');
