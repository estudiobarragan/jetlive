<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Component;
use Livewire\Attributes\Reactive;

class Children extends Component
{
    public $name;
    public $tipo;

    #[Reactive]
    public $name1;

    #[Modelable]
    public $name2;


    public function render()
    {
        if($this->tipo===3 || !($this->tipo===1 || $this->tipo===2)){
            $this->tipo=3;
        }
        return view('livewire.children');
    }
}
