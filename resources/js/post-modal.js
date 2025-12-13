import { Modal } from 'bootstrap';
import Quill from 'quill';

window.addEventListener('alpine:initializing', () => {
    Alpine.data('postModal', () => ({
        isOpen: false,
        editing: false,
        content: '',
        postId: null,
        quill: null,
        bootstrapModal: null,

        init() {
            const modalElement = this.$el;
            this.bootstrapModal = new Modal(modalElement);

            Livewire.on('modal-opened', (data) => {
                this.postId = data.postId;
                this.content = data.content || '';
                this.editing = false;

                // Обновляем Livewire-свойства для отображения в blade
                this.$wire.set('post', { id: this.postId });
                this.$wire.set('content', this.content);

                this.bootstrapModal.show();
                history.pushState({}, '', `/posts/${this.postId}`);
            });

            modalElement.addEventListener('hidden.bs.modal', () => {
                this.isOpen = false;
                this.editing = false;
                this.content = '';
                this.postId = null;
                history.pushState({}, '', '/posts');
                this.$wire.set('post', null);
                this.$wire.set('content', '');

                if (this.quill) {
                    this.quill.destroy();
                    this.quill = null;
                }
            });

            // Popstate
            window.addEventListener('popstate', () => {
                const path = window.location.pathname;
                if (path.startsWith('/posts/') && path !== '/posts') {
                    const id = parseInt(path.split('/').pop());
                    if (!isNaN(id)) {
                        Livewire.dispatch('open-post-modal', { postId: id });
                    }
                } else {
                    this.bootstrapModal.hide();
                }
            });
        },

        startEditing() {
            this.editing = true;
            this.$nextTick(() => {
                if (!this.quill) {
                    this.quill = new Quill('#quill-editor', {
                        theme: 'snow',
                        modules: {
                            toolbar: true
                        }
                    });
                    this.quill.root.innerHTML = this.content;

                    this.quill.on('text-change', () => {
                        this.content = this.quill.root.innerHTML;
                        this.$wire.set('content', this.content, false);
                    });
                }
            });
        },

        close() {
            this.bootstrapModal.hide();
        }
    }));
});