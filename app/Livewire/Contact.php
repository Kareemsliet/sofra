<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    #[Validate('required|string|max:150')]
    public $title;

    #[Validate('string|required|email')]
    public $email;

    #[Validate('string|required|max:150')]
    public $name;

    #[Validate('required|string|max:250')]
    public $description;

    public $replay;

    public $suggestion;

    public $complaint;

    function mount(){
        $this->replay=\App\Status\Contact::replay;
        $this->complaint=\App\Status\Contact::complaint;
        $this->suggestion=\App\Status\Contact::suggestion;
        $this->email=old('email');
        $this->title=old('title');
        $this->name=old('name');
        $this->description=old('description');
    }
    public function render()
    {
        return view('livewire.contact');
    }
}
