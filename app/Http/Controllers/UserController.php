<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function create_account()
    {
        return view('login.create_account');
    }

    public function account_save(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|confirmed|min:5|max:8',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        if($user){
            return redirect()->route('login')->with('msg', 'Account Created, Please Login');
        }

        return view('login.create_account');

    }

    public function login_check(Request $req)
    {
        $checklist = $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($checklist)) {
            $req->session()->regenerate();
            return redirect()->route('home');
        }else{
            return redirect()->route('login')->with('error', 'Invalid Login or Password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('error', 'User logged out');

    }
}
