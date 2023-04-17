<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register form
    public function register()
    {
        return view('users.register');
    }
    //save a user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' =>['required','email',Rule::unique('users','email')],
            'password'=>'required|confirmed|min:8',           
        ]);


        // hashing your password
        $formFields['password']=bcrypt($formFields['password']);

        //creating user
        $user = User::create($formFields);

        //logging in
        auth()->login($user);
  
    return redirect('/')->with('message','The user is created. Thank you for joining us');
    
    }
    //logout a user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','See you soon');
    }
    //show login form
    public function login()
    {
        return view('users.login');
    }
    //authenticate a user to log in
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' =>['required','email'],
            'password'=>'required',           
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message','Successfully logged in');
        }

        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
    }
}
