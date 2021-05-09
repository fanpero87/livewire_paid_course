<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $upload;
    public $files = [];

    public $saved = false;

    protected $rules = [
        'user.username' => 'max:24',
        'user.about' => 'max:140',
        'user.birthday' => 'sometimes',
        'upload' => 'nullable|image|max:1000',
    ];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function save()
    {
        $this->validate();

        $this->user->save();

        // THe "&&" means an implicit if statement
        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/', 'avatars'),
        ]);

        //First option to show a banner with the message
        $this->saved = true;
        //Second option to display a pop-up message on the right side
        $this->dispatchBrowserEvent('notify', 'Profiled saved! ');
        //Third option to show a small message next to the buttons
        $this->emitSelf('notify-saved');
    }

    public function updated($field)
    {
        $this->saved = false;
    }

    public function updatedUpload()
    {
        $this->validate(['upload' => 'image|max:10000']);
    }

    // You can delete the render function if you are not resturning anything
}
