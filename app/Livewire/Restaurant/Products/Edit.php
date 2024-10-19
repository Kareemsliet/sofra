<?php

namespace App\Livewire\Restaurant\Products;

use App\Models\Offer;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $restaurant_id;
    public $product;

    #[Validate('image|required|mimes:png,svg|max:7000')]
    public $image;

    #[Validate('required|required')]
    public $price;

    #[Validate('numeric|required')]
    public $delivery_time;

    #[Validate('string|required|max:150')]
    public $name;

    #[Validate('required|string|max:250')]
    public $description;

    public $offer_id;

    function mount($restaurant_id,$product){
        $this->product=$product;
        $this->restaurant_id=$restaurant_id;
        $this->price=$product->price;
        $this->delivery_time=$product->delivery_time;
        $this->name=$product->name;
        $this->description=$product->description;
        $this->offer_id=$product->offer_id;
    }
    public function render()
    {
        $offers=Offer::select('*')->whereHas('restaurant',function($query){
            $query->where('restaurants.id','=',$this->restaurant_id);
         })->get();
        return view('livewire.restaurant.products.edit',['offers'=>$offers]);
    }
}
