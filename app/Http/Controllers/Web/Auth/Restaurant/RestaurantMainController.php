<?php

namespace App\Http\Controllers\Web\Auth\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestaurantMainController extends Controller
{
    function showLoginForm(){
        return view('web.auth.restaurant.login');
    }

    function showRegisterForm(){

        $cities=City::all();

        $categories=Category::all();

        return view('web.auth.restaurant.register',compact('categories','cities'));
    }
    function register(Request $request){
        $request->validate([
            'delivery_price'=>"required",
            'minimum_order'=>"required",
            'city_id'=>"required",
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

        auth('restaurant')->login($restaurant);

       return redirect()->route('restaurant.index');
    }

    function login(Request $request){
        $request->validate([
            'email'=>"string|required|email",
            'password'=>"required|string|min:8",
        ]);

        if(!auth('restaurant')->attempt($request->only(['email','password']),$request->remember?true:false)){
            return  redirect()->back()->withErrors(['email'=>"لا يوجد بيانات"]);
        }

        return redirect()->route('restaurant.index');
    }

    function logout(Request $request){

        auth('restaurant')->logout();

        return redirect()->route('restaurant.showLoginForm');
    }
}
