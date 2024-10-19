<?php

namespace App\Livewire\Clint;

use Livewire\Attributes\Validate;
use Livewire\Component;

class PasswordReset extends Component
{
    #[Validate('string|email|required')]
    public $email;

    public $token;

    
    #[Validate('required|string|min:8')]
    public $password_confirmation;


    #[Validate('required|string|min:8|confirmed')]
    public $password;

    public function mount($token){
        $this->email=isset($_GET['email'])?$_GET['email']:old('email');
        $this->token=$token;
    }
    public function render()
    {
        return view('livewire.clint.password-reset');
    }
}
