<?php

namespace App\Livewire\Clint\Orders;

use App\Models\Cart;
use App\Models\PaymentMethod;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Add extends Component
{
    #[Validate('max:250|string')]
    public $description;

    public $restaurant;

    

    function mount($restaurant){
        $this->restaurant=$restaurant;
        $this->description=old('description');
    }

    public function render()
    {
        $payment_methods=PaymentMethod::all();

        $client=auth('client')->user();

        $items=Cart::whereHas('product',function($query)use($client){
            $query->where('products.restaurant_id','=',$this->restaurant->id)->where('client_id','=',$client->id);
        })->get();

        $cost=0;

        foreach ($items as $key => $value) {
            if($value->offer_id){
                $cost+=$value->offer_price*$value->quantity;
            }else{
                $cost+=$value->price*$value->quantity;
            }
        }

        $total=$cost+$this->restaurant->delivery_price;

        return view('livewire.clint.orders.add',['payment_methods'=>$payment_methods,'items'=>$items,'cost'=>$cost,'total'=>$total]);
    }
}
