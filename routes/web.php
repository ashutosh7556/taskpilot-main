<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Taskcontroller;

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
    return view('welcome');
});

// Admin dashboard
Route::get('/admin', [Usercontroller::class, 'index'])->name('admin.options');

// Admin options page

Route::get('/option', function () {
    return view('option');
})->name('option');

// Registration

Route::get('/register', [Usercontroller::class, 'index'])->name('register');
Route::post('/register', [Usercontroller::class, 'register'])->name('register.submit');

// Login
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [Usercontroller::class, 'login'])->name('user.login');


Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::post('/dashboard', [Usercontroller::class, 'dashboard'])->name('user.dashboard');

Route::get('/logout', [Usercontroller::class, 'logout'])->name('user.logout');





Route::get('/tasks/create', [TaskController::class, 'create'])->name('Tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');


Route::get('/dashboard', [TaskController::class, 'taskdashboard'])->name('user.dashboard');


Route::put('/taskupdate/{id}/edit', [TaskController::class, 'taskupdate'])->name('taskupdate');
Route::get('/taskupdate/{id}', [TaskController::class, 'taskupdate'])->name('taskupdate');
Route::delete('/taskupdate/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');




Route::get('/taketask', [TaskController::class, 'taketask'])->name('taketask');

