<?php

namespace App\Http\Controllers\Web\Auth\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class RestaurantPasswordController extends Controller
{
    public function forget(){
        return view('web.auth.restaurant.password.forget');
    }

    public function checkEmail(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('restaurants')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    public function reset($token){
        return view('web.auth.restaurant.password.reset',compact('token'));
    }

    function update(Request $request){

        $request->validate([
            'token' => 'required',
            'email'=>"required|email|string",
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('restaurants')->reset(
            $request->only('email','password','token'),
            function (Restaurant $restaurant, string $password) {
                $restaurant->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(length:60));

                $restaurant->save();
            }
        );
        
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('restaurant.showLoginForm')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
