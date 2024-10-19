<?php

namespace App\Http\Controllers\Web\Client;

use App\Events\RestaurantOrders;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Restaurant;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Events\ClientOrders;

class MainController extends Controller
{
     function getCartItems(Request $request){
        return view('web.client.cart');
     }

     function createOrder($restaurant_id){
        $restaurant=Restaurant::findOrFail($restaurant_id);
         return view('web.client.orders.add',['restaurant'=>$restaurant]);
     }

     function addOrder(Request $request,$restaurant_id){
            $client=$request->user();

            $request->validate([
                'description'=>$request->description?"nullable|string|max:250":"",
                'payment_method_id'=>"required|exists:payments_methods,id",
            ]);

            $restaurant=Restaurant::find($request->restaurant_id);


            if($restaurant->statue==\App\Status\Restaruant::CLOSE->value){
                return redirect()->back()->with('message','المطعم غير متاح في الوقت الحالي...')->withInput(['payment_method_id'=>$request->payment_method_id,'description'=>$request->description]);
            }

            $products=Cart::whereHas('product',function($query)use($client,$restaurant){
                $query->where('products.restaurant_id','=',$restaurant->id)->where('client_id','=',$client->id);
            })->get();

            $request->merge(['restaurant_id'=>$restaurant_id]);

            $order=$client->orders()->create($request->only(['restaurant_id','payment_method_id','description']));

            $cost=0;

            foreach ($products as $key => $value) {
                $product=$value->product;
                $order->products()->create([
                    'name'=>$product->name,
                    'price'=>$value->price,
                    'quantity'=>$value->quantity,
                    'description'=>$value->description?$value->description:"",
                ]);
                $cost+=($value->price)*$value->quantity;
            }

            if($cost<$restaurant->minimum_order){
                $order->products()->delete();
                $order->delete();
                return redirect()->back()->with('message','التكلفة الطلب اقل من الحد الادني للمطعم')->withInput(['payment_method_id'=>$request->payment_method_id,'description'=>$request->description]);
            }

            Cart::destroy($products);

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

            event(new RestaurantOrders($restaurant,'طلب جديد',"$client->name هناك طلب جديد من"));

            $restaurant->notify(new OrderNotification('طلب جديد',"$client->name هناك طلب جديد من "));

            return redirect()->route('orders');

        }

        function getOrders(){
            return view('web.client.orders.index');
        }
}
