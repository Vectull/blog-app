<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class PostsList extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = Post::all();
    }

    #[On('post-updated')]
    public function refreshPosts()
    {
        $this->posts = Post::all();
    }

    public function render()
    {
        return view('livewire.posts-list');
    }
}