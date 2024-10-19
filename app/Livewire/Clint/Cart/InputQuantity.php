<?php

namespace App\Livewire\Clint\Cart;

use Livewire\Attributes\Validate;
use Livewire\Component;

class InputQuantity extends Component
{
    #[Validate('required|min:1|max:10|numeric')]
    public $quantity;

    public $item;

    function mount($item){
        $this->quantity=$item->quantity;
        $this->item=$item;
    }

    function changeQuantity(){
        $this->item->update([
            'quantity'=>$this->quantity,
        ]);

        $this->dispatch('update-items');
    }
    public function render()
    {
        return view('livewire.clint.cart.input-quantity');
    }
}
