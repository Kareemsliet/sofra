<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  function index(Request $request){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $cartItems=$client->cartItems;

        $cost=0;

        foreach ($cartItems as $key => $value) {
            $price=$value->price*$value->quantity;
            $cost+=$price;
        }
        
        return responseJson(1,data:[
             'total'=>$cost,
             'items'=>$cartItems,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $validation=validator()->make($request->all(),[
            'quantity'=>"required|numeric",
            'description'=>$request->description?"required|string|max:250":"nullable",
            'product_id'=>"required|exists:products,id",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $product=Product::find($request->product_id);

        $price=$product->offer_id?$product->offer_price:$product->price;

        $request->merge(['price'=>$price]);

        $data=$request->only(['product_id','quantity','price']);

        if($request->description){
            $data['description']=$request->description;
        }

        $itemCart=$client->cartItems()->create($data);

        return responseJson(1,"تم اضافة عنصر للسلة بنجاح",$itemCart);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request,$id){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $validation=validator()->make($request->all(),[
            'quantity'=>"required|numeric",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $cartItem=Cart::find($id);

        $product=$cartItem->product;

        $price=$product->offer_id?$product->offer_price:$product->price;

        $request->merge(['price'=>$price]);

        $data=$request->only(['price','quantity']);

        if($request->description){
            $data['description']=$request->description;
        }

        $cartItem->update($data);

        return responseJson(1,"تم تحديث عنصر للسلة بنجاح",$cartItem);
    }


    /**
     * Remove the specified resource from storage.
     */
    public  function destroy(Request $request,$id){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $cartItem=Cart::find($id);

        if(!$cartItem){
            return responseJson(1,"لا يوجد عنصر فس السلة");
        }

        $cartItem->delete();

        return responseJson(1,"تم حذف عنصر للسلة بنجاح");
    }
}
