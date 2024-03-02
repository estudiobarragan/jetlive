<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Post;
use Livewire\Attributes\Validate;

class PostForm extends Form
{  
    public $id='';
    public $action='';
    public $open='';
    public $imageKey;

    #[Validate('image', message:'The image of the post must be a valid image.')]
    #[Validate('max:1024', message:'The image of the post must be less than 1024kb.')]
    public $image;

    #[Validate('required', message:'The post must have a title.')]
    #[Validate('min:3', message:'The title of the post must have a length of at least 3 characters.')]
    #[Validate('max:255', message:'The title of the post must have a max length of 255 characters.')]
    public $title='';

    #[Validate('required', message:'The post must have content.')]
    #[Validate('min:10', message:'The content of the post must be greater than 10 characters.')]
    public $content='';

    #[Validate('required|exists:categories,id', message:'You must choose a category for your post.')]
    public $category_id='';

    #[Validate('required|array', message:'You must choose at least one label.')]
    public $tags = [];

    public function save()
    {
        if(!$this->image){
            $this->image = ''; //Para que no de error en la validacion
        }

        $this->validate();
        if($this->id>0){
            $post = Post::find($this->id);
            $post->update([
                'category_id' => $this->category_id,
                'title'  => $this->title,
                'content'  => $this->content,
            ]);
            $post->tags()->sync($this->tags);    
            
        }else{
            $post = Post::create(
                $this->only('title','content','category_id')
            );
            $post->tags()->attach($this->tags);

            if($this->image){
                // $post->addMedia($this->image)->toMediaCollection();
                $post->image_path = $this->image->store('posts');
                $post->save();
            }
        }
        $this->reset();
        $this->imageKey =rand();
    }
    

    public function destroy()
    {
        $post = Post::find($this->id);
        $post->delete();
        $this->reset();
    }

    public function new()
    {
        $this->reset();
        $this->action='new';
        $this->imageKey =rand();
        $this->open = true;

    }

    public function edit($postId)
    {
    
        $this->action='edit';
        $this->id = $postId;
        $post = Post::find($postId);

        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tags = $post->tags->pluck('id')->toArray();

        $this->image=$post->image_path;

        $this->open = true;

    }

    public function delete($postId)
    {
        $this->action='delete';
        $this->id = $postId;
        $post = Post::find($postId);

        $this->category_id = $post->category_id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->tags = $post->tags->pluck('id')->toArray();

        $this->open = true;
    }
}
