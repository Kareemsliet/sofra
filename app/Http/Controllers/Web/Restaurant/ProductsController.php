<?php

namespace App\Http\Controllers\Web\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    function index(){
        return view('web.restaurant.products.index');
    }

    public function create(){
        return view('web.restaurant.products.add');
    }

    public function edit($id){
        return view('web.restaurant.products.edit',['product'=>Product::findOrFail($id)]);
    }

    public function store(Request $request){
        $restaurant=auth('restaurant')->user();

         $request->validate([
         'name'=>"required|string|unique:products,name|max:120",
         'image'=>"required|image|mimes:png,svg,jpg,jpeg|max:5550",
         'description'=>"required|max:250|string",
         'price'=>"required|numeric",
         'delivery_time'=>"required|numeric",
         'offer_id'=>$request->offer_id?"exists:offers,id":"",
        ]);

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

        $restaurant->products()->create($data);

        return redirect()->route('product.create')->with('message',"تم انشاء منتج بنجاح");
    }

    public function update(Request $request,$id){

        $restaurant=auth('restaurant')->user();

        $restaurant=$request->user();

        $request->validate([
            'name'=>"required|string|unique:products,name,$id|max:120",
            'image'=>$request->image?"image|mimes:png,svg,jpg,jpeg|max:5550":"",
            'description'=>"required|max:250|string",
            'price'=>"required|numeric",
            'delivery_time'=>"required|numeric",
            'offer_id'=>$request->offer_id?"exists:offers,id":"",
        ]);

        $data=$request->only(['name','description','price','delivery_time']);


        $product=Product::findOrFail($id);

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

        return redirect()->route('product.edit',$product->id)->with('message','تم تعديل منتج بنجاح');
    }
}
