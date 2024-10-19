<?php

namespace App\Livewire\Restaurant\Offers;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $offer;

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

    function mount($offer){
        $this->offer=$offer;
        $this->discount=$offer->discount;
        $this->from=$offer->from;
        $this->to=$offer->to;
        $this->name=$offer->name;
        $this->description=$offer->description;
    }
    public function render()
    {
        return view('livewire.restaurant.offers.edit');
    }
}
