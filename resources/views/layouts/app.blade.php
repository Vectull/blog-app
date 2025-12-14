<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог постов</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-light">
    <div class="container py-5">
        @yield('content')
    </div>

    @livewireScripts

    <!-- Ключевой скрипт: поддержка прямых ссылок /posts/{id} -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Проверяем URL при загрузке страницы
            const path = window.location.pathname;
            const match = path.match(/^\/posts\/(\d+)$/);
            if (match) {
                const postId = parseInt(match[1]);
                Livewire.dispatch('open-post-modal', { postId });
            }

            // При закрытии модального — возвращаем URL на /posts
            const modalEl = document.getElementById('postModal');
            if (modalEl) {
                modalEl.addEventListener('hidden.bs.modal', () => {
                    if (window.location.pathname !== '/posts') {
                        history.pushState(null, '', '/posts');
                    }
                });
            }
        });
    </script>
</body>
</html>