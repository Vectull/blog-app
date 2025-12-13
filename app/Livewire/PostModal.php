<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class PostModal extends Component
{
    public $post = null;
    public $content = '';
    public $editing = false;

    #[On('open-post-modal')]
    public function open($postId)
    {
        $this->post = Post::findOrFail($postId);
        $this->content = $this->post->content;
        $this->editing = false;

        // Открываем модальное чистым Bootstrap JS
        $this->js("
            const modalEl = document.getElementById('postModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
            history.pushState(null, '', '/posts/{$postId}');
        ");
    }

    public function startEditing()
    {
        $this->editing = true;
    }

    public function save()
    {
        $this->post->update(['content' => $this->content]);
        $this->editing = false;
    }

    public function cancel()
    {
        $this->content = $this->post->content;
        $this->editing = false;
    }

    public function render()
    {
        return view('livewire.post-modal');
    }
}