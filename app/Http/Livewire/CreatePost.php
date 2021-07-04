<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    /**
     * Manage the status of the modal
     * @var bool
     */
    public $open = false;

    public $title, $content;

    protected $rules = [
        'title' => 'required|max:20',
        'content' => 'required|max:100',
    ];

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

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        $this->reset(['open', 'title', 'content']);

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
