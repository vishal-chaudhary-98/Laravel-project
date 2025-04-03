<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/register','user.forms.register');
Route::post('/user-registration', [Usercontroller::class,'register'])->name('register-user');

Route::view('/login','user.forms.login')->name('login');
Route::post('/user-login',[UserController::class,'login'])->name('user.login');

Route::view('/dashboard','user.auth.dashboard')->middleware('auth:user');

//  ROUTES FOR AUTHENTICATED USER SHOW VIEW ONLY
Route::get('/edit/profile',[UserController::class, 'editProfilePage'])->name('edit/profile');
Route::get('edit/password',[UserController::class, 'editPasswordPage'])->name('change/password');

//  ROUTES FOR AUTHENTICATED USER UPDATE DATA ONLY
Route::post('/update/personal/information',[UserController::class, 'updateProfile'])->name('update/profile');
Route::post('update/password',[UserController::class,'updatePassword'])->name('update-password');



Route::post('/logout',[UserController::class,'logout']);


// ROUTES FOR ADMIN USER ONLY
Route::view('/admin','admin.adminLogin')->name('admin');

// Route: :post('/admin/register',[AdminController::class,'register'])->name('register');
Route::post('/login/admin',[AdminController::class,'adminLogin'])->name('admin_login');

Route::get('/ad',[AdminController::class, 'adminDashboard'])->name('admin_dashboard')->middleware('auth:admin');
Route::view('/admin/loggedin/dashboard' , 'admin.authAdmin.dashboard')->middleware('auth:admin');

Route::view('/users','admin.authAdmin.view_users')->name('view_users')->middleware('auth:admin');
Route::get('/view/users',[AdminController::class, 'viewUsers'])->name('all_users')->middleware('auth:admin');

Route::post('/admin/logout',[AdminController::class, 'logout'])->name('admin-logout');

