<?php

namespace App\Livewire\Restaurant;

use Livewire\Attributes\Validate;
use Livewire\Component;

class PasswordForget extends Component
{
    #[Validate('string|email|required|exists:restaurants,email')]
    public $email;

    public function mount(){
        $this->email=old('email');
    }
    public function render()
    {
        return view('livewire.restaurant.password-forget');
    }
}
