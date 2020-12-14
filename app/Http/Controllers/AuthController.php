<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Auth;
use Debugbar;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function sign_in(){
        return view('sign_in');
    }

    public function sign_out(){
        Auth::logout();
        return redirect("home");
    }

    public function reg(){
        return view('reg');

    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

    //============================================================

    public function show_login_form()
    {
        return view('login');
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('name',$request->name)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('home');

        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }
    public function show_signup_form()
    {
        return view('register');
    }
    public function process_signup(Request $request)
    {
        $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => ['required', 'confirmed']

        ]);

        $user = User::create([
            'firstname' => trim($request->input('firstname')),
            'lastname' => trim($request->input('lastname')),
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
        ]);

        session()->flash('message', 'Your account is created');

        return redirect()->route('login');
    }
    public function logout()
    {
        Auth::logout();

        //return redirect()->route('home');
        return redirect('home');
    }
}
