<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You are logged out.');
    }

    public function showCorrectHomepage()
    {
        if(auth()->check()) {
            return view('home-feed');
        } else {
            return view('home');
        }
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginusername' => 'required',
            'loginpassword' => 'required'
        ]);

        if( auth()->attempt([ 'username' => $incomingFields['loginusername'], 'password' => $incomingFields['loginpassword'] ]) ) {
            return redirect('/')->with('success', 'You have successfully logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid Login');
        }

    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => ['required', 'min:3', 'max:8', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        User::create($incomingFields);
        return redirect('/')->with('success', 'User registration successfully, Please login now');
    }
}
