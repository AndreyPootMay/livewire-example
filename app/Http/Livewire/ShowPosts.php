<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class ShowPosts extends Component
{
    public $search;

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

    protected $listeners = [
        'render' => 'render'
    ];

    public function render()
    {
        $posts = Post::where('title', 'like', "%{$this->search}%")
            ->orWhere('content', 'like', "%{$this->search}%")
            ->orderBy($this->sort, $this->direction)
            ->get();

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
}
