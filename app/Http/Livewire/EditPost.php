<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;

    public $post;
    public $open = false;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function save()
    {
        $this->validate();
        $this->post->save();

        $this->reset(['open']);
        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'Post updated successfully');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
