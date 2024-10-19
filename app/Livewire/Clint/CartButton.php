<?php

namespace App\Livewire\Clint;

use Livewire\Component;

class CartButton extends Component
{
    public $product;
    function mount($product){
        $this->product=$product;
    }

    function addItem(){
        $client=auth('client')->user();


        $cartItem=$client->cartItems()->where('product_id','=',$this->product->id)->first();

        if(!$cartItem){
            $client->cartItems()->create([
                'product_id'=>$this->product->id,
                'quantity'=>1,
                'price'=>$this->product->offer_id?$this->product->offer_price:$this->product->price,
            ]);
        }else{
            $cartItem->update([
                'quantity'=>$cartItem->quantity+1,
            ]);
        }

        $this->dispatch('cart');
    }

    public function render()
    {
        return view('livewire.clint.cart-button');
    }
}
