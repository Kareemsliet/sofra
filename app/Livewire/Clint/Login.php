<?php

namespace App\Livewire\Clint;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Login extends Component
{
    #[Validate('required|string|email')]
    public $email;

    #[Validate('required|string|min:8')]
    public $password;

    public function mount(){
        $this->email=old('email');
    }

    public function render()
    {
        return view('livewire.clint.login');
    }
}
