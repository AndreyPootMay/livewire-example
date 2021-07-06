<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    /**
     * Manage the status of the modal
     * @var bool
     */
    public $open = false;

    public $title, $content, $image, $identifier;

    protected $rules = [
        'title' => 'required|max:20',
        'content' => 'required|max:100',
        'image' => 'required|image|max:2048'
    ];

    public function mount(): void
    {
        $this->identifier = rand();
    }

    /**
     * Manage the validation of a form property reactively
     * @param   string  $propertyName
     * @return  void
     */
    public function updated(string $propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Add new Post model to the Database.
     * @return  void
     */
    public function save(): void
    {
        $this->validate();

        $image = $this->image->store('posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image,
        ]);

        $this->reset(['open', 'title', 'content', 'image']);

        $this->identifier = rand();

        $this->emitTo('show-posts', 'render');
        $this->emit('alert', 'The post has been created successfully!');
    }

    /**
     * Render create-post component
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function render()
    {
        return view('livewire.create-post');
    }
}
