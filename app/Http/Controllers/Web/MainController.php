<?php

namespace App\Http\Controllers\Web;

use App\Events\ClientOrders;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function home()
    {
        // $client=auth('client')->user();
        // event(new ClientOrders(client: $client,"",""));
        return view('web.index');
    }

    public function getRestaurant($id){
        $restaurant=Restaurant::findOrFail($id);
        $products=$restaurant->products()->paginate(10);
        return view('web.restaurant.show',['restaurant'=>$restaurant,'products'=>$products]);
    }

    public function getProduct($id){
        $product=Product::findOrFail($id);

        $restaurant=$product->restaurant;

        $products=$restaurant->products()->orderBY('created_at','DESC')->limit(8)->get();

        $more_products=[];

        foreach($products as $value){
            if($value->id!=$product->id){
                $more_products[]=$value;
            }
        }

        return view('web.product',['product'=>$product,'products'=>$more_products]);
    }

    function contactPage(){
        return view('web.contact');
    }

    function addContact(Request $request){
        $request->validate([
            'name'=>"required|string",
            'email'=>"required|email|string",
            'description'=>"string|required|max:250",
            'title'=>"required|string|max:100",
            'type'=>"required",
        ]);

        Contact::create($request->only(['name','email','title','description','type']));

        return redirect()->route('contact')->with('message','شكرا للتواصل معنا');
    }

}
