<?php

namespace App\Http\Controllers\Web\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OffersController extends Controller
{
    function index(){
        return view('web.restaurant.offers.index');
    }

    public function create(){
        return view('web.restaurant.offers.add');
    }

    public function edit($id){
        return view('web.restaurant.offers.edit',['offer'=>Offer::findOrFail($id)]);
    }

    public function store(Request $request){

        $restaurant=auth('restaurant')->user();

        $today=now()->toDateTime()->format('y-m-d');


        $request->validate([
         'name'=>"required|string|unique:offers,name|max:120",
         'image'=>"required|image|mimes:png,svg,jpg,jpeg|max:5550",
         'description'=>"required|max:250|string",
         'from'=>"required|date|after_or_equal:$today",
         'to'=>"required|date|after_or_equal:$today",
         'discount'=>"required|numeric|min:5|max:100",
        ]);

        $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

        $request->file('image')->storeAs('/restaurants/offers',$image,['disk'=>'public']);

        $data=$request->only(['name','description','from','to','discount']);

        $data['image']=$image;

        $restaurant->offers()->create($data);

        return redirect()->route('offer.create')->with('message',"تم  انشاء عرض بنجاح");
    }

    public function update(Request $request,$id){
        $restaurant=$request->user();

        $today=now()->toDate()->format('y-m-d');

        $request->validate([
            'name'=>"required|string|unique:offers,name,$id|max:120",
            'image'=>$request->image?"image|mimes:png,svg,jpg,jpeg|max:5550":"",
            'description'=>"required|max:250|string",
            'from'=>"required|date|after_or_equal:$today",
            'to'=>"required|date|after_or_equal:$today",
            'discount'=>"required|numeric|min:5|max:100",
        ]);

        $offer=Offer::findOrFail($id);

        $data=$request->only(['name','description','from','to','discount']);

        if($request->file('image')){
            Storage::delete('/restaurants/offers/'.$offer->image);

            $image=uniqid().'.'.$request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/restaurants/offers',$image,['disk'=>'public']);

            $data['image']=$image;
        }

          $offer->update($data);

          return redirect()->route('offer.edit',$offer->id)->with('message',"تم  تحديث عرض بنجاح");


    }
}
