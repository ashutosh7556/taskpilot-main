<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminoptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| that contains the "web" middleware group. Now create something great!
|
*/ 

// Home page
Route::get('/home', function () {
    return view('welcome')->name('home'); // loads welcome.blade.php
});

// Admin dashboard
Route::get('/admin', [AdminoptionController::class, 'index'])->name('admin.options');

// Admin options page
Route::get('/option', function () {
    return view('option'); 
})->name('option');

// Registration form
Route::get('/register', function () {
    return view('register'); 
});

Route::post('/register', [AdminoptionController::class, 'register'])->name('register.submit');

 Route::get('/login', function () {
    return view('login'); 
});

 Route::post('/login', [AdminoptionController::class, 'login'])->name('user.login');

 Route::get('/dashboard', function () {
    return view('dashboard');
});

// Handle dashboard-related POST actions (optional use case)
Route::post('/dashboard', [AdminoptionController::class, 'dashboard'])->name('user.dashboard');

Route::get('/logout', [AdminoptionController::class, 'logout'])->name('user.logout');
