<?php

namespace App\Http\Controllers\Web\Auth\Client;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientMainController extends Controller
{
    function showLoginForm(){
        return view('web.auth.client.login');
    }

    function showRegisterForm(){

        return view('web.auth.client.register');
    }
    function register(Request $request){
       $request->validate([
            'region_id'=>"required|exists:regions,id",
            'city_id'=>"required|exists:cities,id",
            'name'=>"string|required|unique:clients,name",
            'email'=>"required|string|email|unique:clients,email",
            'password'=>"required|string|min:8|confirmed",
            'phone'=>"required|numeric|unique:clients,phone",
        ]);

        $request->merge([
            'password'=>Hash::make($request->password),
        ]);

        $data=$request->only(['name','email','phone','minimum_order','delivery_price','region_id','password','image']);


        $client=Client::create($data);

        auth('client')->login($client,$remember=true);

        return redirect()->route('index');
    }

    function login(Request $request){
        $request->validate([
            'email'=>"string|required|email",
            'password'=>"required|string|min:8",
        ]);

        if(!auth('client')->attempt($request->only(['email','password']),$remember=true)){
           return  redirect()->back()->withErrors(['email'=>"لا يوجد بيانات"]);
        }

        return redirect()->route('index');
    }

    function logout(Request $request){

        auth('client')->logout();

        return redirect()->route('client.showLoginForm');
    }
}
