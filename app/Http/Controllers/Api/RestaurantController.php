<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{

    public function getNotifications(Request $request){
        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        return responseJson(1,"التنبيهات",[
            'unread'=>$restaurant->unreadNotifications,
            'read'=>$restaurant->readNotifications,
        ]);
    }

    function getAvailableOrders(){
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=Order::select('*')->whereHas('restaurant',function($q)use($restaurant){
            $q->where('restaurants.id','=',$restaurant->id)->where('orders.statue',\App\Status\Order::PENDING->value);
        })->get();

        return responseJson(1,"الطلبات الحالية",$orders);
    }

    function getNewOrders(){
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=Order::select('*')->whereHas('restaurant',function($q)use($restaurant){
            $q->where('restaurants.id','=',$restaurant->id)->where('orders.statue',\App\Status\Order::ACCEPT->value);
        })->get();

        return responseJson(1,"الطلبات الجديدة",$orders);
    }

    function getOldOrders(){
        $restaurant=auth('sanctum')->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,"لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=Order::select('*')->whereHas('restaurant',function($q)use($restaurant){
            $q->where('restaurants.id','=',$restaurant->id)->where('orders.statue',\App\Status\Order::REJECT->value)->orWhere('orders.statue',\App\Status\Order::DELIVERIED->value)->orWhere('orders.statue',\App\Status\Order::DECLINE->value);
        })->get();

        return responseJson(1,"الطلبات السابقة",$orders);
    }
    public function rejectOrder(Request $request,$id){
        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $order=Order::find($id);

        if(!$order){
            return responseJson(statue: 0,message: "لا يوحد بيانات");
        }

        $client=Client::find($order->client_id);

        $order->update(['statue'=>\App\Status\Order::REJECT->value]);

        $client->notify(new OrderNotification("تم رفض الطلب من المطعم","م رفض الطلب من المطعم"));

        return responseJson(statue: 0,message: "تم تاكيد رفض الطلب بنجاح");
    }

    public function deliveryOrder(Request $request,$id){
        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $order=Order::find($id);

        if(!$order){
            return responseJson(statue: 0,message: "لا يوحد بيانات");
        }

        $client=Client::find($order->client_id);

        $order->update(['statue'=>\App\Status\Order::DELIVERIED->value]);

        $client->notify(new OrderNotification("تم تسليم الطلب من المطعم","م تسليم الطلب من المطعم"));

        return responseJson(statue: 0,message: "تم تاكيد تسليم الطلب بنجاح");
    }
    public function acceptOrder(Request $request,$id){
        $restaurant=auth('sanctum')->user();

        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $order=Order::find($id);

        if(!$order){
            return responseJson(statue: 0,message: "لا يوحد بيانات");
        }

        $client=Client::find($order->client_id);

        $order->update(['statue'=>\App\Status\Order::ACCEPT->value]);

        $client->notify(new OrderNotification("تم موافقة علي الطلب من المطعم","الطلب من المطعم"));

        return responseJson(statue: 0,message: "تم تاكيد موافقة الطلب بنجاح");
    }

    public function getInfo(Request $request){
        $restaurant=$request->user();

        if(!$restaurant->tokenCan('restaurant')){
            return responseJson(statue: 0,message: "لا يوجد لهذا الرمز صلاحية  دخول");
        }

        $orders=$restaurant->orders()->where('orders.statue',\App\Status\Order::DELIVERIED->value)->get();

        $payments=$restaurant->payments()->sum('total');

        $data=[
            'total'=>$orders->sum('total'),
            'commissions'=>$orders->sum('commission'),
            'net'=>$orders->sum('net'),
            'payments'=>$payments,
            'payment_price'=>$orders->sum('commission')-$payments
        ];

        return responseJson(0,"حسابات المطعم",$data);

    }
}

