<div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $post?->title ?? '' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(!$editing)
                    <div wire:click="startEditing" style="cursor: pointer; min-height: 200px;" class="border p-3 rounded bg-light">
                        {!! $content !!}
                    </div>
                @else
                    <div id="quill-editor"></div>
                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button wire:click="save" class="btn btn-primary">Сохранить</button>
                        <button wire:click="cancel" class="btn btn-secondary">Отмена</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Quill инициализируем при редактировании
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('start-editing', () => {
            if (!window.quill) {
                window.quill = new Quill('#quill-editor', {
                    theme: 'snow'
                });
                @this.on('content-updated', (content) => {
                    window.quill.root.innerHTML = content;
                });
                window.quill.on('text-change', () => {
                    @this.set('content', window.quill.root.innerHTML);
                });
            }
        });

        // Закрытие модального — возврат URL
        const modalEl = document.getElementById('postModal');
        modalEl.addEventListener('hidden.bs.modal', () => {
            history.pushState(null, '', '/posts');
        });

        // Поддержка прямых ссылок
        if (window.location.pathname.match(/^\/posts\/\d+$/)) {
            const postId = window.location.pathname.split('/').pop();
            Livewire.dispatch('open-post-modal', { postId });
        }
    });
</script>