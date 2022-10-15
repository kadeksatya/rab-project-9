<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        # code...

        if(Auth::guard('web')->check()){
            return redirect()->back();
        }

        return view('auth.login', [
            'page_name' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        # code...
        $users = User::where('username', $request->username)->first();
        if($users == null){
            return redirect()->back()->withErrors('Username not found');
        }

        $credential = $request->only(['username', 'password']);

        if(Auth::attempt($credential)){
            return redirect()->route('dashboard.index')->with('message','Login Successfully !');
        }

        return redirect()->back()->withErrors('Login Failed , try again !');
    }

    public function logout()
    {
        # code...

        Auth::logout();

        return redirect('/')->with('message', 'Logout Successfuly !');
    }
}
