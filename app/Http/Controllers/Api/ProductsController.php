<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        return responseJson(1,data:$restaurant->products);
    }

    /**
     * Store a newly created resource in storage.
     */
     function store(Request $request){

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

         $validation=validator()->make($request->all(),[
         'name'=>"required|string|unique:products,name|max:120",
         'image'=>"required|image|mimes:png,svg,jpg,jpeg|max:5550",
         'description'=>"required|max:250|string",
         'price'=>"required|numeric",
         'delivery_time'=>"required|numeric",
         'offer_id'=>$request->offer_id?"exists:offers,id":"",
        ]);

        if($validation->fails()){
           return responseJson(0,data:$validation->errors());
        }

        $data=$request->only(['name','description','price','delivery_time']);

        $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->storeAs('/restaurants/products',$image,['disk'=>'public']);

        $data['image']=$image;

        if($request->offer_id){
            $offer=Offer::where('id',$request->offer_id)->where('restaurant_id',$restaurant->id)->first();

            if(!$offer){
                return responseJson(1,"لايوحد عروض كهذا للمطعم");
            }
            $data['offer_id']=$offer->id;

            $price=$request->price-($request->price*($offer->discount/100));

            $data['offer_price']=(float) $price;
        }

        $product=$restaurant->products()->create($data);

        return responseJson(1,"تم اضافى منتج للمطعم بنحاح",$product);
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

        $product=Product::find($id);
        if(!$product){
            return responseJson(1,"لا يوجد بيانات ");
        }
        return responseJson(1,$product);
    }
    /**
     * Update the specified resource in storage.
     */
    function update(Request $request,$id){

        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $validation=validator()->make($request->all(),[
            'name'=>"required|string|unique:products,name,$id|max:120",
            'image'=>$request->image?"image|mimes:png,svg,jpg,jpeg|max:5550":"",
            'description'=>"required|max:250|string",
            'price'=>"required|numeric",
            'delivery_time'=>"required|numeric",
            'offer_id'=>$request->offer_id?"exists:offers,id":"",
        ]);

        $data=$request->only(['name','description','price','delivery_time']);

        if($validation->fails()){
              return responseJson(0,data:$validation->errors());
        }

        $product=Product::find($id);

        if(!$product){
             return responseJson(0,message:"لايوجد بيانات");
        }

        if($request->file('image')){
            Storage::delete('/restaurants/products/'.$product->image);

            $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/restaurants/products',$image,['disk'=>'public']);

            $data['image']=$image;
        }

        if($request->offer_id){
            $offer=Offer::where('id',$request->offer_id)->where('restaurant_id',$restaurant->id)->first();

            if(!$offer){
                return responseJson(1,"لايوحد عروض كهذا للمطعم");
            }

            $data['offer_id']=$offer->id;

            $product_price=$request->price;

            $price=$product_price-($product_price*($offer->discount/100));

            $data['offer_price']=(float)$price;
        }else{
            $data['offer_id']=null;
            $data['offer_price']=null;
        }

        $product->update($data);

        return responseJson(1,"تم تحديث عرض للمطعم بنحاح",$product);

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

        $product=Product::find($id);
        if($product){
            Storage::delete('/restaurants/offers/'.$product->image);
            $product->delete();
        }else{
            return responseJson(1,"لاتوجد بيانات");
        }
        return responseJson(1,"تم حذف عر بنجاح");
    }
}
