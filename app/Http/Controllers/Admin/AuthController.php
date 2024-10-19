<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    function showLoginForm(){
        return view('admin.auth.login');
    }

    function login(Request $request){

        $request->validate([
            'email'=>"required|email|string",
            'password'=>"required|string|min:8",
        ]);

        if(!auth()->attempt($request->only(['email','password']),$request->remember?true:false)){
            return back()->withErrors(['email'=>"لاتجد بيانات  معرفة بهذا"]);
        }

        return  redirect()->route('admin.index');
    }

    function logout(Request $request){

       auth()->logout();

       return  redirect()->route('admin.loginForm');
    }

    function forgetPassword(){
        return view('admin.auth.password');
    }

    function resetPassword(Request $request){

        $request->validate([
            'email'=>"required|email|string",
            'password'=>"required|string|min:8|confirmed",
        ]);

        $user=User::where('email',$request->email)->first();

        if(!$user){
            return back()->withErrors(['email'=>"لاتجد بيانات  معرفة بهذا"]);
        }


        $user->update(['password'=>Hash::make($request->password)]);

        return  redirect()->route('admin.loginForm');
    }
}
