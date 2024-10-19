<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Restaurant;
use App\Notifications\OrderNotification;
use App\Status\Restaruant;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\ArrayItem;

class ClientController extends Controller
{
    public function addRate(Request $request){
        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $validation=validator()->make($request->all(),[
            'rate'=>"required|numeric|min:1|max:5",
            'comment'=>"required|string|max:250",
            'restaurant_id'=>"required|exists:restaurants,id",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $rate=$client->ratings()->create($request->only(['rate','comment','restaurant_id']));

        return responseJson(1,data:$rate);
    }

    public function addOrder(Request $request){

        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $validation=validator()->make($request->all(),[
            'products'=>"required|array|min:1",
            'products.*.id'=>"required|exists:products,id",
            'products.*.quantity'=>"required",
            'restaurant_id'=>"required|exists:restaurants,id",
            'description'=>$request->description?"nullable|string|max:250":"",
            'payment_method_id'=>"required|exists:payments_methods,id",
        ]);

        if($validation->fails()){
            return responseJson(0,data:$validation->errors());
        }

        $restaurant=Restaurant::find($request->restaurant_id);

        if($restaurant->statue==Restaruant::CLOSE->value){
            return responseJson(0,message:"هذا المطعم غير متح حاليا");
        }

        $order=$client->orders()->create($request->only(['restaurant_id','payment_method_id','description']));

        $cost=0;

        foreach ($request->products as $key => $value) {
            $product=Product::find($value['id']);
            $order->products()->create([
                'product_id'=>$product->id,
                'price'=>$product->offer_id?$product->offer_price:$product->price,
                'quantity'=>$value['quantity'],
                'description'=>$product->description?$product->description:"",
            ]);
            $cost+=($product->offer_id?$product->offer_price:$product->price)*$value['quantity'];
        }

        if($cost<$restaurant->minimum_order){
            $order->products()->delete();
            $order->delete();
            return responseJson(0,message:"تكلفة اقل من الحد الادني للمطعم");
        }

        $commission=setting()->commission*$cost;  // عمولة التطبيق

        $total=$cost+$restaurant->delivery_price;  // السعر الاصلي

        $net=$total-$commission;  // صافي الربح من العمولة

        $order->update([
            'commission'=>(float) $commission,
            'cost'=>(float) $cost, // سعر المنجات
             'delivery_cost'=>$restaurant->delivery_price,
             'net'=>$net,
             'total'=>$total,
        ]);

        $restaurant->notify(new OrderNotification('تلتتلا','the notification'));

        return responseJson(1,"تم اضافة طلب للمطعم تابع التنبيهات",$order);
    }

    public function getNotifications(Request $request){
        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        return responseJson(1,"التنبيهات",$client->notifications);
    }

    function getNewOrders(){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=Order::select('*')->whereHas('client',function($q)use($client){
            $q->where('clients.id','=',$client->id)->where('orders.statue',\App\Status\Order::PENDING->value)->orWhere('orders.statue',\App\Status\Order::ACCEPT->value);
        })->get();

        return responseJson(1,"الطلبات الحالية او الجديدة",$orders);
    }

    function getOldOrders(){
        $client=auth('sanctum')->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=Order::select('*')->whereHas('client',function($q)use($client){
            $q->where('clients.id','=',$client->id)->where('orders.statue',\App\Status\Order::REJECT->value)->orWhere('orders.statue',\App\Status\Order::DELIVERIED->value)->orWhere('orders.statue',\App\Status\Order::DECLINE->value);
        })->get();

        return responseJson(1,"الطلبات السابقة",$orders);
    }

    public function rejectOrder(Request $request,$id){
        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $order=Order::find($id);

        if(!$order){
            return responseJson(statue: 0,message: "لا يوحد بيانات");
        }

        $restaurant=Restaurant::find($order->restaurant_id);

        $order->update(['statue'=>\App\Status\Order::REJECT->value]);

        $restaurant->notify(new OrderNotification('تم رفض الطلب من العميل','تم رفض الطلب من العميل'));

        return responseJson(statue: 0,message: "تم تاكيد رفض الطلب بنجاح");
    }

    public function deliveryOrder(Request $request,$id){
        $client=auth('sanctum')->user();

        $client=$request->user();

        if(!$client->tokenCan('client')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $order=Order::find($id);

        if(!$order){
            return responseJson(statue: 0,message: "لا يوحد بيانات");
        }

        $restaurant=Restaurant::find($order->restaurant_id);

        $order->update(['statue'=>\App\Status\Order::DELIVERIED->value]);

        $restaurant->notify(new OrderNotification('تم تاكيد التسليم  الطلب من العميل','تم تاكيد  تسليم الطلب من العميل'));

        return responseJson(statue: 0,message: "تم تاكيد تسليم الطلب بنجاح");
    }

}
