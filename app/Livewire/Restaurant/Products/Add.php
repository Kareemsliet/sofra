<?php

namespace App\Livewire\Restaurant\Products;

use App\Models\Offer;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;
    public $restaurant_id;

    #[Validate('image|required|mimes:png,svg,jpg,jpeg|max:7000')]
    public $image;

    #[Validate('numeric|required')]
    public $price;

    #[Validate('numeric|required')]
    public $delivery_time;

    public $offer_id;

    #[Validate('string|required|max:150')]
    public $name;

    #[Validate('required|string|max:250')]
    public $description;

    function mount($restaurant_id){
        $this->restaurant_id=$restaurant_id;
        $this->price=old('price');
        $this->delivery_time=old('delivery_time');
        $this->name=old('name');
        $this->description=old('description');
        $this->offer_id=old('offer_id');
    }
    public function render()
    {
        $offers=Offer::select('*')->whereHas('restaurant',function($query){
           $query->where('restaurants.id','=',$this->restaurant_id);
        })->get();
        return view('livewire.restaurant.products.add',['offers'=>$offers]);
    }
}
