<?php

namespace App\Livewire\Restaurant\Offers;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    #[Validate('image|required|mimes:png,svg,jpg,jpeg|max:7000')]
    public $image;

    #[Validate('numeric|required')]
    public $discount;

    #[Validate("required|date")]
    public $from;

    #[Validate("required|date")]
    public $to;

    #[Validate('string|required|max:150')]
    public $name;

    #[Validate('required|string|max:250')]
    public $description;

    function mount(){
        $this->discount=old('discount');
        $this->from=old('from');
        $this->to=old('to');
        $this->name=old('name');
        $this->description=old('description');
    }
    public function render()
    {
        return view('livewire.restaurant.offers.add');
    }
}
