<div class="modal fade" id="postModal" tabindex="-1" aria-hidden="true" x-data="postModal">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" x-text="$store.postModal.title || ''"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <template x-if="!editing">
                    <div @click="startEditing" class="p-4 border rounded bg-light" style="cursor: pointer; min-height: 250px;">
                        <div x-html="$store.postModal.content || '<p>Кликните, чтобы редактировать...</p>'"></div>
                    </div>
                </template>

                <template x-if="editing">
                    <div>
                        <div id="quill-editor" style="min-height: 300px;"></div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <button @click="save" class="btn btn-primary">Сохранить</button>
                            <button @click="cancel" class="btn btn-secondary">Отмена</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>

@script
<script>
    Alpine.store('postModal', {
        content: '',
        postId: null,
        title: ''
    });

    document.getElementById('postModal')?.addEventListener('hidden.bs.modal', () => {
        history.pushState(null, '', '/posts');
        Alpine.store('postModal').content = '';
        Alpine.store('postModal').postId = null;
        Alpine.store('postModal').title = '';
    });
</script>
@endscript