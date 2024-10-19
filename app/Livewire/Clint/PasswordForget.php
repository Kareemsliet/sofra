<?php

namespace App\Livewire\Clint;

use Livewire\Attributes\Validate;
use Livewire\Component;

class PasswordForget extends Component
{

    #[Validate('string|email|required|exists:clients,email')]
    public $email;

    public function mount(){
        $this->email=old('email');
    }
    public function render()
    {
        return view('livewire.clint.password-forget');
    }
}
