<?php

namespace App\Livewire\Restaurant;

use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Register extends Component
{
    use WithFileUploads;

    #[Validate('required|string|unique:restaurants,name|max:50')]
    public $name;


    #[Validate('required|numeric|unique:restaurants,phone')]
    public $phone;

    #[Validate('required|string|unique:restaurants,email|email')]
    public $email;

    #[Validate('required|string|min:8')]
    public $password_confirmation;


    #[Validate('required|string|min:8|confirmed')]
    public $password;

    #[Validate('required|exists:cities,id')]
    public $city_id;

    #[Validate('required|exists:regions,id')]
    public $region_id;

    #[Validate('image|required|mimes:png,jpg,jpeg,svg|max:6000')]
    public $image;

    #[Validate('required|numeric')]
    public $minimum_order;

    #[Validate('required|numeric')]
    public $delivery_price;

    #[Validate('required|numeric')]
    public $phone_call;

    #[Validate('required|numeric')]
    public $whatsapp_phone;



    function mount(){
         $this->name=old('name');
         $this->email=old('email');
         $this->phone=old('phone');
         $this->city_id=old('city_id');
         $this->region_id=old('region_id');
         $this->minimum_order=old('minimum_order');
         $this->delivery_price=old("delivery_price");
         $this->phone_call=old("phone_call");
         $this->whatsapp_phone=old('whatsapp_phone');
    }

    public function render()
    {
        $regions=null;
        if($this->city_id){
            $regions=Region::select('*')->whereHas('city',function($query){
                $query->where('cities.id','=',$this->city_id);
            })->get();
        }
        return view('livewire.restaurant.register',['regions'=>$regions,'cities'=>City::all(),'categoryOptions'=>Category::all()]);
    }
}

