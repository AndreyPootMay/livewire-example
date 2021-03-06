<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    /**
     * Search
     * @var string
     */
    public $search = '';

    /**
     * The new post or the request post.
     * @var Post
     */
    public $post;

    public $identifier;

    public $image;

    /**
     * Quantity of posts.
     * @var int
     */
    public $quantity = '10';

    public $readyToLoad = false;

    protected $queryString = [
        'quantity' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    /**
     * Manage the status of the edit modal.
     * @var bool
     */
    public $open_edit = false;

    /**
     * Sort by column
     * @var string
     */
    public $sort = 'id';

    /**
     * Sort order must be 'asc' or 'desc'
     * by default are 'desc'
     * @var string
     */
    public $direction = 'desc';

    protected $listeners = ['render', 'delete'];

    /**
     * Manage the mount of the livewire component.
     * @return  void
     */
    public function mount(): void
    {
        $this->identifier = rand();
        $this->open_edit = false;
        $this->post = new Post();
    }

    /**
     * Loading posts.
     * @return void
     */
    public function loadPosts(): void
    {
        $this->readyToLoad = true;
    }

    /**
     * Lifecycle function in livewire.
     * Trigger and reset pagination if the $search property
     * has been changed.
     * @url https://laravel-livewire.com/docs/2.x/lifecycle-hooks
     * @return  void
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    /**
     * Post model validation rules
     * @var array
     */
    protected array $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    /**
     * Render the component with data.
     * @return mixed
     */
    public function render()
    {
        $posts = [];

        if ($this->readyToLoad) {
            $posts = Post::where([
                ['title', 'like', "%{$this->search}%"],
                ['active', '=', 1]
            ])
            ->orWhere('content', 'like', "%{$this->search}%")
            ->orderBy($this->sort, $this->direction)
            ->paginate($this->quantity);
        }

        return view('livewire.show-posts', [
            'posts' => $posts
        ]);
    }

    /**
     * Sort items as a datatable function
     * @param   string  $sort
     * @return  void
     */
    public function order(string $sort): void
    {
        if ($this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    /**
     * Edit an post opening the modal.
     * @param   Post  $post
     * @return  void
     */
    public function edit(Post $post): void
    {
        $this->post = $post;
        $this->open_edit = true;
    }

    /**
     * Manage the update of the post model.
     * @return mixed
     */
    public function update()
    {
        $this->validate();

        if ($this->image) {
            Storage::delete([$this->post->image]);

            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open_edit', 'image']);
        $this->identifier = rand();

        $this->emit('alert', 'Post updated successfully');
    }

    /**
     * Manage the deletion of a post model
     * @param   Post  $post
     * @return  mixed
     */
    public function delete(Post $post): void
    {
        $post->update(['active' => 0]);
    }
}
