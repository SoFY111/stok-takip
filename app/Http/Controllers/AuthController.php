<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//MODELS
use App\Models\User;

class AuthController extends Controller
{
    public function loginPost(Request $request){

        if($request->rememberMe){
            if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password],true))
                return redirect()->route('dashboard');
            return redirect()->route('login')->withErrors('Email adresi veya şifre hatalı');
        }
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],false))
            return redirect()->route('dashboard');
        return redirect()->route('login')->withErrors('Email adresi veya şifre hatalı');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
