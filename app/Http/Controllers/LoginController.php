<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admins;
 

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // your single login page
    }

    public function login(Request $request)
    {
        // Validate email and password inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:3',
        ]);

        $credentials = $request->only('email', 'password');

        // Try User guard
        if (Auth::guard('web')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('user.dashboard'));
        }

        // Try Admin guard
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            return redirect()->intended(route('admin.dashboard'));
        }

        // If both fail, redirect back with error and old input
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)    
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Optional method to create a default admin (use with caution)
    public function createAdminAccount()
    {
        Admins::create([
 
            'email' => 'ashu7556@gmail.com',
            'password' => Hash::make('123'),
        ]);

        return 'Admin created successfully!';
    }
}
