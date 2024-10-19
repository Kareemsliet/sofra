<?php

namespace App\Livewire\Restaurant;

use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public $setting;
    public $restaurant;

    function mount(){
        $this->restaurant=auth('restaurant')->user();

        $this->setting=setting();
    }

    function getListeners(){
        return [
            "echo-private:App.Models.Restaurant.{$this->restaurant->id},RestaurantOrders"=>"notify"
        ];
    }

    function notify($event): void{
        $this->dispatch('order',title:$event['title'],des:$event['description']);
    }

    public function render()
    {
        return view('livewire.restaurant.header');
    }
}
