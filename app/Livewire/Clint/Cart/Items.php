<?php

namespace App\Livewire\Clint\Cart;

use App\Models\Cart;
use App\Models\Restaurant;
use Livewire\Attributes\On;
use Livewire\Component;

class Items extends Component
{
    function deleteItem($id){
        $cart=Cart::find($id);

        $cart->delete();
    }

    #[On('update-items')]
    public function render()
    {
        $client=auth('client')->user();

        $restaurants=Restaurant::whereHas('products',function($query)use($client){
          $query->whereHas('cartItem',function($query)use($client){
            $query->where('carts.client_id','=',$client->id);
          });
        })->orderByDesc('created_at')->paginate(5);

        return view('livewire.clint.cart.items',['restaurants'=>$restaurants]);
    }
}
