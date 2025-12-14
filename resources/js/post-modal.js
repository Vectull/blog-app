import Quill from 'quill';

document.addEventListener('alpine:init', () => {
    Alpine.data('postModal', () => ({
        editing: false,
        quill: null,
        originalContent: '',

        init() {
            this.originalContent = Alpine.store('postModal').content || '';

            // Очистка Quill при закрытии модального (важно!)
            const modalEl = document.getElementById('postModal');
            modalEl.addEventListener('hidden.bs.modal', () => {
                this.editing = false;
                if (this.quill) {
                    this.quill = null; // Полная очистка
                }
                // Очищаем контейнер на всякий случай
                const editor = document.querySelector('#quill-editor');
                if (editor) editor.innerHTML = '';
            });
        },

        startEditing() {
            this.editing = true;
            this.$nextTick(() => {
                // Всегда создаём новый инстанс Quill
                const container = document.querySelector('#quill-editor');
                if (container && !this.quill) {
                    this.quill = new Quill(container, {
                        theme: 'snow',
                        modules: {
                            toolbar: true
                        }
                    });

                    this.quill.root.innerHTML = Alpine.store('postModal').content || '';

                    this.quill.on('text-change', () => {
                        Alpine.store('postModal').content = this.quill.root.innerHTML;
                    });
                }
            });
        },

        save() {
            Livewire.dispatch('save-post-content', {
                content: Alpine.store('postModal').content
            });

            this.originalContent = Alpine.store('postModal').content;
            this.editing = false;

            // Закрываем модальное
            const modal = bootstrap.Modal.getInstance(document.getElementById('postModal'));
            if (modal) modal.hide();
        },

        cancel() {
            Alpine.store('postModal').content = this.originalContent;
            this.editing = false;

            // Закрываем модальное при отмене (по желанию)
            const modal = bootstrap.Modal.getInstance(document.getElementById('postModal'));
            if (modal) modal.hide();
        }
    }));
});