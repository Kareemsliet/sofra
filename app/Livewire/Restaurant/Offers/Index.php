<?php

namespace App\Livewire\Restaurant\Offers;

use App\Models\Offer;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $restaurant_id;

    function mount($restaurant){
        $this->restaurant_id=$restaurant;
    }

    public function deleteOffer($id){
        $offer=Offer::find($id);
        Storage::delete('/restaurants/offers/'.$offer->image);
        $offer->delete();
    }
    public function render()
    {
        $offers=Offer::select('*')->whereHas('restaurant',function($query){
            $query->where('restaurants.id','=',$this->restaurant_id);
        })->paginate(10);

        return view('livewire.restaurant.offers.index',['offers'=>$offers]);
    }
}
