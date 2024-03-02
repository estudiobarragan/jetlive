<?php

namespace App\Livewire;
use Livewire\Component;

class Father extends Component
{

    public $name = 'Jose';
    public $name1 = 'Jose';
    public $name2 = 'Jose';

    public function render()
    {
        return view('livewire.father');
    }

    public function redirigir()
    {
        return $this->redirect('/spa',navigate:true);
    }
}
