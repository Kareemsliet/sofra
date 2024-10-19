<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    function index(Request $request){

        $search=$request->q?$request->q:"";

        $restaurants=Restaurant::select('*')->whereHas('region',function($query)use($search){
            $query->whereAny(['restaurants.name','restaurants.email','restaurants.phone'],'like',"%$search%")->orWhere('regions.name','like',"$search")->orWhereHas('city',function($query)use($search){
                 $query->where('cities.name','like',"%$search%");
            });
        })->orderByDesc('created_at')->paginate(10);

        $restaurants->withQueryString();

        return view('admin.restaurants.index',compact('restaurants'));
    }

    function destroy(Request $request,$id){

        $restaurant=Restaurant::findOrFail($id);

        if(count($restaurant->conections)>0){
            $restaurant->conections()->delete();
        }

        if(count($restaurant->categories)>0){
            $restaurant->categories()->sync([]);
        }

        if(count($restaurant->notifications)>0){
         $restaurant->notifications()->delete();
        }

        if(count($restaurant->orders)>0){
            $restaurant->orders()->delete();
        }

        if(count($restaurant->products)>0){
            $restaurant->products()->delete();
        }

        if(count($restaurant->payments)>0){
            $restaurant->payments()->delete();
        }

        if(count($restaurant->offers)>0){
            $restaurant->offers()->delete();
        }

        if(count($restaurant->ratings)>0){
            $restaurant->ratings()->delete();
        }

        $restaurant->delete();

        return redirect()->route('restaurants.index')->with("message","تم حذف مستخدم بنجاح");
    }
}
