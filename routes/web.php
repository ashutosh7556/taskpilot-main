<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Taskcontroller;
use App\Http\Controllers\Logincontroller;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/home', function () {
    return view('welcome');
});


Route::get('/admin', [Usercontroller::class, 'index'])->name('admin.options');

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

// ✅ REMOVED THIS DUPLICATE LINE:
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// User dashboard route (this is the one that passes $tasks)
Route::get('/task/dashboard', [TaskController::class, 'taskdashboard'])->name('user.dashboard');
Route::post('/task/dashboard', [Usercontroller::class, 'dashboard'])->name('user.dashboard');

Route::get('/logout', [Usercontroller::class, 'logout'])->name('user.logout');

// Task routes
Route::get('/tasks/create', [TaskController::class, 'create'])->name('Tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

Route::put('/taskupdate/{id}/edit', [TaskController::class, 'taskupdate'])->name('taskupdate');
Route::get('/taskupdate/{id}', [TaskController::class, 'taskupdate'])->name('taskupdate');
Route::delete('/taskupdate/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

Route::get('/load-take-task/{id}', [TaskController::class, 'loadTakeTask']);
Route::post('/task-taken', [TaskController::class, 'TakeTask'])->name('TakeTask');

// Login (additional set)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login2');
Route::post('/login', [LoginController::class, 'login'])->name('login2.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout2');

// Protected routes

Route::middleware('auth:web')->group(function () {
    Route::get('/user/dashboard', [TaskController::class, 'taskdashboard'])->name('user.dashboard');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/admins/dashboard', function () {
        return view('admindashboard');
    })->name('admin.dashboard');
});

Route::get('/create-admin', [LoginController::class, 'createAdminAccount']);


// Admin dashboard
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])
    ->name('admin.dashboard')
    ->middleware('auth:admin');

// Assign task to user (handled in TaskController)
Route::post('/assign-task', [TaskController::class, 'assignTask'])
    ->name('admin.assignTask')
    ->middleware('auth:admin');



// Update task (admin)
Route::put('/admin/task/{id}', [AdminController::class, 'updateTask'])
    ->name('admin.task.update')
    ->middleware('auth:admin');

// Delete task (admin)
Route::delete('/admin/task/{id}', [AdminController::class, 'deleteTask'])
    ->name('admin.task.delete')
    ->middleware('auth:admin');


Route::get('/showusers', [LoginController::class, 'show'])->name('user.show');


Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('user.delete');

Route::get('/showTasks', [LoginController::class, 'show'])->name('Task.show');





