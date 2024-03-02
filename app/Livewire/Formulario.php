<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Lazy;
use Livewire\WithFileUploads;
use App\Livewire\Forms\PostForm;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

// #[Lazy]
class Formulario extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $categories,$tags;
    public $onlyShow=false;

    public PostForm $post;

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function render()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(5, pageName:'pagePosts');
        return view('livewire.formulario', compact('posts'));
    }

    /* public function paginationView()
    {
        return 'vendor.livewire.simple-tailwind';
    } */
    public function new()
    {
        $this->resetValidation();
        $this->post->new();
    }
    public function edit($postId)
    {
        $this->resetValidation();
        $this->post->edit($postId);
    }
    public function delete($postId)
    {
        $this->resetValidation();
        $this->post->delete($postId);
    }

    public function sendForm()
    {
        if($this->post->action==="new"){
            $this->post->save();
            $this->dispatch('postAction','Save a new Post');
        }elseif($this->post->action==="edit"){
            $this->post->save();
            $this->dispatch('postAction','Update a Post');
        }elseif($this->post->action==="delete"){
            $this->post->destroy();
            $this->dispatch('postAction','Delete a Post');
        }
        $this->resetPage(pageName:'pagePosts');
    }
    public function cancel()
    {
        $this->post->open = false;
        $this->post->reset();
    }

    public function placeholder()
    {
        return view('livewire.placeholders.skeleton');
    }
}
