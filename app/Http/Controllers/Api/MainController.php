<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Setting;
use App\Status\Restaruant;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function addContact(Request $request){
        $validation=validator()->make($request->all(),[
            'name'=>"required|string",
            'email'=>"required|email|string",
            'description'=>"string|required|max:250",
            'title'=>"required|string|max:100",
            'type'=>"required|in:0,1,2",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $contact=Contact::create($request->only(['name','email','title','description','type']));

        return responseJson(1,"سيتم الرد عليك في اقرب وقت تابع البريد الاكتروني الذي ارسلة بع الرسالة",$contact);
    }
    function getRestaurants(Request $request){
       $validation=validator()->make($request->all(),[
            'city'=>$request->city_id?"exists:cities,id":"nullable",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $search=$request->search?$request->search:"";

        if($request->city){
           $restraunts=Restaurant::select('*')->whereHas('region',function($q)use($request,$search){
              $q->where('regions.city_id','=',$request->city)->where('restaurants.name','like',"%$search%");
           })->orderByDesc('created_at')->where('statue',Restaruant::OPEN->value)->paginate(10);
        }else{
           $restraunts=Restaurant::select('*')->where('name','like',"%$search%")->where('statue',Restaruant::OPEN->value)->orderByDesc('created_at')->paginate(10);
        }

        $restraunts->withQueryString();

        return responseJson(1,$restraunts);
    }
    public function getCategories(){
        return responseJson(1,"success",data:Category::all());
    }

    public function getCities(){
        return responseJson(1,"success",City::all());
    }

    public function getRegions(){
        return responseJson(1,"success",Region::all());
    }

    public function getRegionsByCity($city_id){
        $regions=Region::select('*')->where('city_id','=',$city_id)->get();
        return responseJson(1,"success",$regions);
    }

    public function getPaymentMethods(){
        return responseJson(1,"success",PaymentMethod::all());
    }

    public function setting(){
        return responseJson(1,"الاعدادات",Setting::first());
    }

    public function getRestaurantRatings($id){
       $restaurant=Restaurant::find($id);

       if(!$restaurant){
        return responseJson(1,"المطعم غير موجود");
       }

       return responseJson(1,"المطاعم",$restaurant->ratings);
    }

    public function getRestaurantOffers($id){
        $restaurant=Restaurant::find($id);

        if(!$restaurant){
         return responseJson(1,"المطعم غير موجود");
        }

        return responseJson(1,"success",$restaurant->offers);
    }

    public function getRestaurantProducts($id){
      $restaurant=Restaurant::find($id);

       if(!$restaurant){
        return responseJson(1,"المطعم غير موجود");
       }

       return responseJson(1,"success",$restaurant->products);
    }

    public function getRestaurant($id){
        $restaurant=Restaurant::with('conections')->find($id);

       if(!$restaurant){
        return responseJson(1,"المطعم غير موجود");
       }

       return responseJson(1,"success",$restaurant);
    }

    public function getProduct($id){
        $product=Product::find($id);

       if(!$product){
        return responseJson(1,"  امنتج غير موجود");
       }

       return responseJson(1,"success",$product);
    }
}


