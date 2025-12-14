<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;

class PostModal extends Component
{
    public $post = null;
    public $content = '';

    #[On('open-post-modal')]
    public function open($postId)
    {
        $this->post = Post::findOrFail($postId);
        $this->content = $this->post->content ?: '<p>Кликните, чтобы редактировать...</p>';

        $this->js("
            const modalEl = document.getElementById('postModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
            history.pushState(null, '', '/posts/{$postId}');

            // Передаём контент в Alpine
            Alpine.store('postModal', {
                content: " . json_encode($this->content) . ",
                postId: {$postId},
                title: " . json_encode($this->post->title) . "
            });
        ");
    }

   #[On('save-post-content')]
public function savePostContent($content)
{
    if ($this->post) {
        $this->post->update(['content' => $content]);
        $this->content = $content;
    }
}
    public function render()
    {
        return view('livewire.post-modal');
    }
}