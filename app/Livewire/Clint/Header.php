<?php

namespace App\Livewire\Clint;

use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public $setting;

    public $client;

    function mount(){
        if(auth('client')->user()){
            $this->client=auth('client')->user();
        }
        $this->setting=setting();
    }

    function getListeners(){
        return [
            "echo-private:App.Models.Client.{$this->client->id},ClientOrders"=>"notify"
        ];
    }
    function notify($event){
        $this->dispatch('order',title:$event['title'],des:$event['description']);
    }

    #[On('cart')]

    public function render()
    {
        $countCartItems=auth('client')->user()->cartItems()->count('id');

        return view('livewire.clint.header',['countCartItems'=>$countCartItems]);
    }
}
