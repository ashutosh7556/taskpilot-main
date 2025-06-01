    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminoptionController;
    use App\Http\Controllers\LoginController;


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
    
    // Show login form (for both admin and user)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login2');

    // Handle login form submission
    Route::post('/login', [LoginController::class, 'login'])->name('login2.post');

    // Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout2');

    // --- PROTECTED ROUTES ---

    // User dashboard (only for authenticated users)
    Route::middleware('auth:web')->group(function () {
        Route::get('/user/dashboard', function () {
            return view('dashboard');  // or your actual user dashboard view
        })->name('user.dashboard');
    });

    // Admin dashboard (only for authenticated admins)
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admins/dashboard', function () {
            return view('admin');
         })->name('admin.dashboard');   
    });
    
// Route::get('/create-admin', [LoginController::class, 'createAdminAccount']);