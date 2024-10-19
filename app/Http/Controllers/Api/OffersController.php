<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        return responseJson(1,data:$restaurant->offers);
    }

    /**
     * Store a newly created resource in storage.
     */
    function store(Request $request){

        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $today=now()->toDateTime()->format('y-m-d h:m:s');

        $validation=validator()->make($request->all(),[
         'name'=>"required|string|unique:offers,name|max:120",
         'image'=>"required|image|mimes:png,svg,jpg,jpeg|max:5550",
         'description'=>"required|max:250|string",
         'from'=>"required|date|date_format:y-m-d h:m:s|after_or_equal:$today",
         'to'=>"required|date|date_format:y-m-d h:m:s|after_or_equal:$today",
         'discount'=>"required|numeric|min:5|max:100",
        ]);

        if($validation->fails()){
           return responseJson(0,data:$validation->errors());
        }

        $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->storeAs('/restaurants/offers',$image,['disk'=>'public']);

        $data=$request->only(['name','description','from','to','discount']);

        $data['image']=$image;

        $offer=$restaurant->offers()->create($data);

        return responseJson(1,"تم اضافى عرض للمطعم بنحاح",$offer);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $offer=Offer::find($id);
        if(!$offer){
            return responseJson(1,"لا يوجد بيانات ");
        }
        return responseJson(1,$offer);
    }

    /**
     * Update the specified resource in storage.
     */
    function update(Request $request,$id){
        $restaurant=$request->user();


        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $today=now()->toDate()->format('y-m-d h:m:s');

        $validation=validator()->make($request->all(),[
            'name'=>"required|string|unique:offers,name,$id|max:120",
            'image'=>$request->image?"image|mimes:png,svg,jpg,jpeg|max:5550":"",
            'description'=>"required|max:250|string",
            'from'=>"required|date|date_format:y-m-d h:m:s|after_or_equal:$today",
            'to'=>"required|date|date_format:y-m-d h:m:s|after_or_equal:$today",
            'discount'=>"required|numeric|min:5|max:100",
        ]);

        if($validation->fails()){
              return responseJson(0,data:$validation->errors());
        }

        $offer=Offer::find($id);

        if(!$offer){
             return responseJson(0,message:"لايوجد بيانات");
        }

        $data=$request->only(['name','description','from','to','discount']);

        if($request->file('image')){
            Storage::delete('/restaurants/offers/'.$offer->image);

            $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/restaurants/offers',$image,['disk'=>'public']);

            $data['image']=$image;
        }

          $offer->update($data);

         return responseJson(1,"تم تحديث عرض للمطعم بنحاح",$offer);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $offer=Offer::find($id);
        if($offer){
            Storage::delete('/restaurants/offers/'.$offer->image);
            $offer->delete();
        }else{
            return responseJson(1,"لاتوجد بيانات");
        }
        return responseJson(1,"تم حذف عر بنجاح");
    }
}
