<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RestaurantAuthController extends Controller
{

    function register(Request $request){
        $validation=validator()->make($request->all(),[
            'delivery_price'=>"required",
            'minimum_order'=>"required",
            'region_id'=>"required|exists:regions,id",
            'name'=>"string|required|unique:restaurants,name",
            'email'=>"required|string|email|unique:restaurants,email",
            'password'=>"required|string|min:8|confirmed",
            'phone'=>"required|numeric|unique:restaurants,phone",
            'image'=>"required|image|mimes:png,jpg,svg,jpeg|max:5500",
            'whatsapp_phone'=>"required|numeric|unique:restaurants_conections,whatsapp",
            'phone_call'=>"required|numeric|unique:restaurants_conections,phone",
            'categories'=>"required|array|min:1",
            'categories.*'=>"exists:categories,id"
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->storeAs('/restaurants',$image,['disk'=>'public']);

        $request->merge([
            'password'=>Hash::make($request->password),
        ]);

        $data=$request->only(['name','email','phone','minimum_order','delivery_price','region_id','password','image']);

        $data['image']=$image;

        $restaurant=Restaurant::create($data);

        $restaurant->conections()->create([
            'whatsapp'=>$request->whatsapp_phone,
            'phone'=>$request->phone_call
        ]);

        $restaurant->categories()->sync($request->categories);

        $token=$restaurant->createToken('restaurant_token',['restaurant'],now()->addWeek())->plainTextToken;

        return responseJson(1,"تم انشاء حساب مطعم بنجاح",[
            'token'=>$token,
            'restaurant'=>$restaurant,
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

         $restaurant=Restaurant::where('email','=',$request->email)->first();

         if($restaurant){
            if(Hash::check($request->password,$restaurant->password)){
                $token=$restaurant->createToken('restaurant_token',['restaurant'],now()->addWeek())->plainTextToken;
                return responseJson(1,"تسجيل الدخول بنجاح",[
                    'token'=>$token,
                    'restaurant'=>$restaurant,
                ]);
            }else{
                return responseJson(0,"لايوجد بيانات -حاول مرة  اخري");
            }
         }else{
            return responseJson(0,"لايوجد بيانات -حاول مرة  اخري");
         }
    }

    function logout(Request $request){
        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

         $restaurant->currentAccessToken()->delete();

         return responseJson(0,"تسجيل الخروج بنجاح");
    }

    function resetPassword(Request $request){
        $validation=validator()->make($request->all(),[
            'email'=>"string|required|email",
            'password'=>"required|string|min:8|confirmed",
        ]);

        if($validation->fails()){
            return responseJson(0,$validation->errors());
         }

         $restaurant=Restaurant::where('email','=',$request->email)->first();

         if($restaurant){
            $restaurant->update([
                'password'=>Hash::make($request->password),
            ]);
            return responseJson(1,"تم تحديث كلمة المرور بنجاح");
         }else{
            return responseJson(0,"لايوجد بيانات -حاول مرة  اخري");
         }
    }
}
