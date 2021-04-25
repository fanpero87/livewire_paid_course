<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $saved = false;
    public $username = '';
    public $about = '';

    protected $rules = [
        'username' => 'max:24',
        'about' => 'max:140',
    ];

    public function mount()
    {
        $this->username = auth()->user()->username;
        $this->about = auth()->user()->about;
    }

    public function save()
    {
        $this->validate();

        auth()->user()->update([
            'username' => $this->username,
            'about' => $this->about,
        ]);

        $this->saved = true;
    }

    public function updated($field)
    {
        $this->saved = false;
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
