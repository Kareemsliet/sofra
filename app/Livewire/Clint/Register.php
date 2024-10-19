<?php

namespace App\Livewire\Clint;

use App\Models\City;
use App\Models\Region;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|string|unique:clients,name|max:50')]
    public $name;
    

    #[Validate('required|numeric|unique:clients,phone')]
    public $phone;

    #[Validate('required|string|unique:clients,email|email')]
    public $email;

    #[Validate('required|string|min:8')]
    public $password_confirmation;


    #[Validate('required|string|min:8|confirmed')]
    public $password;

    #[Validate('required|exists:cities,id')]
    public $city_id;

    #[Validate('required|exists:regions,id')]
    public $region_id;

    function mount(){
         $this->name=old('name');
         $this->email=old('email');
         $this->phone=old('phone');
         $this->city_id=old('city_id');
         $this->region_id=old('region_id');
    }

    public function render()
    {
        $regions=null;
        if($this->city_id){
            $regions=Region::select('*')->whereHas('city',function($query){
                $query->where('cities.id','=',$this->city_id);
            })->get();
        }

        return view('livewire.clint.register',['regions'=>$regions,'cities'=>City::all()]);
    }
}
