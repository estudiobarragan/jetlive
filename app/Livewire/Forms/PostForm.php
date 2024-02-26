<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class PostForm extends Form
{
    public $title='';
    public $content='';
    public $category_id='';
    public $tags = [];
}
