<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostCard extends Component
{
    public $post;

  public function openModal()
{
    $this->dispatch('open-post-modal', postId: $this->post->id);
}
    public function render()
    {
        return view('livewire.post-card');
    }
}