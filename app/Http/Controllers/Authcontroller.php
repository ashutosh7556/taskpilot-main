<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{

     public function login(Request $request)  {

        $user = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:3',
        ]);

        // echo print_r($value);die();

        if (Auth::attempt($user)) {
            return redirect()->route('user.dashboard');
        }


    }

     public function dashboard() {

        if (Auth::check()) {
       return  view('dashboard');
    }
     }
}
