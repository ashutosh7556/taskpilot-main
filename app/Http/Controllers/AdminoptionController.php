<?php

namespace App\Http\Controllers;

 use App\Models\Admin_reg; // Ensure this is the correct model
//  use Illuminate\Support\Facades\Hash;
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
 
         //  $data['password'] = Hash::make($data['password']);
 
         $admin = Admin_reg::create($data); 
 
         if ($admin) {
            
             return redirect()->route('user.login');
  
            }  
             
     }


     public function login(Request $request)  {

        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:3', 
        ]);        

        // echo print_r($value);die();

        if (Auth::attempt($user)) {

            return redirect()->route('user.dashboard');
        }
        else {
            return redirect('register');
        }

 
    }

     public function dashboard() {

        if (Auth::check());
            return view('dashboard');
        
  
    }
 


    public function logout() {

        if (Auth::logout());
            return view('login');

         
  
    }
}




 