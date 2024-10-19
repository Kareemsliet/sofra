<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    function register(Request $request){
        $validation=validator()->make($request->all(),[
            'region_id'=>"required|exists:regions,id",
            'name'=>"string|required|unique:clients,name",
            'email'=>"required|string|email|unique:clients,email",
            'password'=>"required|string|min:8|confirmed",
            'phone'=>"required|numeric|unique:clients,phone",
        ]);

        if($validation->fails()){
           return responseJson(0,data:$validation->errors());
        }

        $request->merge([
            'password'=>Hash::make($request->password),
        ]);

        $data=$request->only(['name','email','phone','minimum_order','delivery_price','region_id','password','image']);


        $client=Client::create($data);

        $token=$client->createToken('client_token',['client'],now()->addWeek())->plainTextToken;

        return responseJson(1,"تم انشاء حساب بنجاح",[
            'token'=>$token,
            'client'=>$client,
        ]);
    }

    function login(Request $request){
        $validation=validator()->make($request->all(),[
            'email'=>"string|required|email",
            'password'=>"required|string|min:8",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
         }

         $client=Client::where('email','=',$request->email)->first();

         if($client){
            if(Hash::check($request->password,$client->password)){
                $token=$client->createToken('client_token',['client'],now()->addWeek())->plainTextToken;
                return responseJson(1,"تسجيل الدخول بنجاح",[
                    'token'=>$token,
                    'client'=>$client,
                ]);
            }else{
                return responseJson(0,"لايوجد بيانات -حاول مرة  اخري",['email'=>"لايوجد بيانات -حاول مرة  اخري"]);
            }
         }else{
            return responseJson(0,"لايوجد بيانات -حاول مرة  اخري",['email'=>"لايوجد بيانات -حاول مرة  اخري"]);
         }
    }

    function logout(Request $request){
        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

         $client->currentAccessToken()->delete();

         return responseJson(1,"تسجيل الخروج بنجاح");
    }

    function resetPassword(Request $request){
        $validation=validator()->make($request->all(),[
            'email'=>"string|required|email",
            'password'=>"required|string|min:8|confirmed",
        ]);

        if($validation->fails()){
            return responseJson(0,$validation->errors());
         }

         $client=Client::where('email','=',$request->email)->first();

         if($client){
            $client->update([
                'password'=>Hash::make($request->password),
            ]);
            return responseJson(1,"تم تحديث كلمة المرور بنجاح");
         }else{
            return responseJson(0,"لايوجد بيانات -حاول مرة  اخري",['email'=>"لايوجد بيانات -حاول مرة  اخري"]);
         }
    }
}
