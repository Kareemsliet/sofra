<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    function index(Request $request){

        $search=$request->q?$request->q:"";

        $clients=Client::select('*')->whereHas('region',function($query)use($search){
            $query->whereAny(['clients.name','clients.email','clients.phone'],'like',"%$search%")->orWhere('regions.name','like',"$search")->orWhereHas('city',function($query)use($search){
                 $query->where('cities.name','like',"%$search%");
            });
        })->orderByDesc('created_at')->paginate(10);

        $clients->withQueryString();

        return view('admin.clients.index',compact('clients'));
    }

    function destroy(Request $request,$id){

        $client=Client::findOrFail($id);

        if(count($client->orders)>0){
            $client->orders()->delete();
        }

        if(count($client->ratings)>0){
            $client->ratings()->delete();
        }

        if(count($client->cartItems)>0){
         $client->cartItems()->delete();
        }

        if(count($client->notifications)>0){
            $client->notifications()->delete();
        }

        $client->delete();

        return redirect()->route('clients.index')->with("message","تم حذف مستخدم بنجاح");
    }

}
