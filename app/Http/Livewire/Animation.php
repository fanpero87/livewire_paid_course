<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;

class Animation extends Component
{

    public $things = [
        ['id' => 1, 'title' => 'Study'],
        ['id' => 2, 'title' => 'Clean'],
        ['id' => 3, 'title' => 'Sleep'],
        ['id' => 4, 'title' => 'Run'],
        ['id' => 5, 'title' => 'Eat'],
    ];

    public function shuffle()
    {
        $this->things = Arr::shuffle($this->things);
    }

    public function render()
    {
        return view('livewire.animation');
    }
}
