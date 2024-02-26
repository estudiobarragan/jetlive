<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;

class Formulario extends Component
{
    public $categories,$tags,$posts;

    public $open=false;
    public $action='';

    #[Validate([
        'post.title' =>'required|min:3|max:255',
        'post.content' => 'required|min:10',
        'post.category_id' => 'required|exists:categories,id',
        'post.tags' => 'required|array', 
    ], message:[
        'post.title.required' => 'The post must have a title.',
        'post.title.min'    =>'The title of the post must have a length of at least 3 characters.',
        'post.title.max'    =>'The title of the post must have a max length of 255 characters.',
        'post.content.required' => 'The post must have content.',
        'post.content.min' => 'The content of the post must be greater than 10 characters.',
        'post.category_id' => 'You must choose a category for your post.',
        'post.tags' => 'You must choose at least one label.'
    ])]
    public $post=[
        'id' => '',
        'title'  => '',
        'content'  => '',
        'category_id' => '',
        'tags' => [],
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->tags = Tag::all();
    }

    public function render()
    {
        $this->posts = Post::orderBy('created_at','desc')->get();
        return view('livewire.formulario');
    }

    public function new()
    {
        $this->post['id'] = '';
        $this->post['category_id'] = '';
        $this->post['title'] = '';
        $this->post['content'] = '';
        $this->post['tags'] = [];
        $this->action='new';

        $this->open = true;
    }

    public function edit($postId)
    {
        $this->action='edit';
        $this->post['id'] = $postId;
        $post = Post::find($postId);
        $this->post['category_id'] = $post->category_id;
        $this->post['title'] = $post->title;
        $this->post['content'] = $post->content;
        $this->post['tags'] = $post->tags->pluck('id')->toArray();

        $this->open = true;

    }
    public function delete($postId)
    {
        $this->action='delete';
        $this->post['id'] = $postId;
        $post = Post::find($postId);
        $this->post['category_id'] = $post->category_id;
        $this->post['title'] = $post->title;
        $this->post['content'] = $post->content;
        $this->post['tags'] = $post->tags->pluck('id')->toArray();

        $this->open = true;
    }

    public function sendForm()
    {
        
        if($this->action==="new"){
            $this->validate();
            $post = Post::create([
                'category_id' => $this->post['category_id'],
                'title'  => $this->post['title'],
                'content'  => $this->post['content'],
            ]);
            $post->tags()->attach($this->post['tags']);
            
        }elseif($this->action==="edit"){
            $this->validate();
            $post = Post::find($this->post['id']);
            $post->update([
                'category_id' => $this->post['category_id'],
                'title'  => $this->post['title'],
                'content'  => $this->post['content'],
            ]);
            $post->tags()->sync($this->post['tags']);

        }elseif($this->action==="delete"){
            $post = Post::find($this->post['id']);
            $post->delete();
        }

        $this->reset(['post','action','open']);

    }

}
