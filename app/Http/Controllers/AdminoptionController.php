<?php
namespace App\Http\Controllers;

use App\Models\User; // Make sure this is the correct model
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminoptionController extends Controller
{
 public function index()
    {
        return view('option');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'password' => 'required|string|min:3|confirmed', 
        ]);

        // You might want to hash the password here
        // $data['password'] = Hash::make($data['password']);

        $admin =User::create($data); 

        if ($admin) {
            return redirect()->route('login2');  // Redirect to your new login route
        }  
    }

    // Remove or comment out this old login method:
    /*
    public function login(Request $request)  
    {
        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:3', 
        ]);        

        if (Auth::attempt($user)) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect('register');
        }
    }
    */

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        // Optionally redirect to login if not authenticated
        return redirect()->route('login2');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login2');
    }
}
