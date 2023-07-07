<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserController extends Controller
{
    //Show the Register/Create Form
    public function createForm() {
        return view('user.register');
    }

    //Show the Login Form
    public function loginForm() {
        return view('user.login');
    }

    // Register the User

    public function register(Request $request) {
        $userFields = $request->validate([
            "name"=>'required',
            "email"=>['required', 'email', 'unique:users'],
            'password'=> ['required', 'min:6', 'confirmed']
        ]);
        $userFields['password'] = bcrypt($userFields['password']);
        $user = User::create($userFields);
        FacadesAuth::login($user);

        return redirect('/')->with("You have successfully register with us");

    }

    // Logout the user
    
    public function logout(Request $request) {
        FacadesAuth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with("Message", "Logged out Successfully");
    }

    // User Logging IN

    public function login(Request $request) {
        $userFields =  $request->validate([
            "email" => "required",
            "password" => "required",
        ]);

        if(FacadesAuth::attempt($userFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('Message', 'Successfully Logged IN');
        }

        return back()->withErrors(['email' => "Please Provide correct creds"])->onlyInput('email');
    }
}
