<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    // Show registration form (no roles needed here)
    public function index()
    {
        return view('register');
    }
    public function adminDashboard()
    {
        $users = User::with('tasks')->get(); // eager load tasks
        return view('admindashboard', compact('users'));
    }


    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|numeric|min:3|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 2;

        $user = User::create($data);

        if ($user) {
            return redirect()->route('login2.post')->with('success', 'Registration successful, please login.');
        }

        return back()->with('error', 'Registration failed');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:3',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard');
        } else {

            return redirect()->route('user.login')->withErrors(['login' => 'Invalid credentials']);
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect()->route('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login2.post');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
