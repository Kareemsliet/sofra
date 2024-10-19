<?php

namespace App\Livewire\Restaurant\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $retaurant_id;
    function mount($restaurant){
        $this->retaurant_id=$restaurant;
    }

    function deleteProduct($id){
        $product=Product::find($id);
        Storage::delete('/restaurants/products/'.$product->image);
        $product->delete();
    }
    public function render()
    {
        $products=Product::select('*')->whereHas('restaurant',function($query){
            $query->where('restaurants.id','=',$this->retaurant_id);
        })->paginate(10);
        return view('livewire.restaurant.products.index',['products'=>$products]);
    }
}
