<?php

namespace App\Livewire;

use App\Models\City;
use App\Models\Restaurant;
use App\Status\Restaruant;
use Livewire\Component;

class Restaurants extends Component
{
    public $city_id;

    public $search="";

    public function findRestaurants(){
    if($this->city_id){
        $restaurants=Restaurant::select('*')->whereHas('region',function($query){
            $query->where('regions.city_id','=',$this->city_id)->whereAny(['restaurants.name'],'like',"%$this->search%");
        })->where('statue','=',Restaruant::OPEN->value)->paginate(10);
    }else{
        $restaurants=Restaurant::select()->whereAny(['name'],'like',"%$this->search%")->where('statue','=',Restaruant::OPEN->value)->paginate(10);
    }
        return $restaurants;
    }

    public function render()
    {
        $restaurants=$this->findRestaurants();

        return view('livewire.restaurants',['cities'=>City::all(),'restaurants'=>$restaurants]);
    }
}
