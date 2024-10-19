<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    function index(Request $request){

        $search=$request->q?$request->q:"";

        $orders=Order::select('*')->orWhereHas('restaurant',function($query)use($search){
            $query->whereAny(['restaurants.name'],'like',"%$search%");
        })->orWhereHas('client',function($query)use($search){
           $query->whereAny(['clients.name'],'like',"%$search%")
           ->orWhereHas('region',function($query)use($search){
            $query->where('regions.name','like',"%$search%")
            ->orWhereHas('city',function($query)use($search){
                $query->where('cities.name','like',"%$search%");
            });
           });
        })->orWhereHas('paymentMethod',function($query)use($search){
            $query->where('payments_methods.name','like',"%$search%");
        })->orderByDesc('created_at')->paginate(10);

        $orders->withQueryString();

        return view('admin.orders.index',compact('orders'));
    }

    function destroy(Request $request,$id){

        $order=Order::findOrFail($id);

        if(count(value: $order->products)>0){
            $order->products()->delete();
        }

        $order->delete();

        return redirect()->route('orders.index')->with("message","تم حذف مستخدم بنجاح");
    }
}
