<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Пост 1: Добро пожаловать!',
                'content' => '<h1>Приветствую в блоге!</h1><p>Это <strong>первый</strong> пост. Здесь мы будем тестировать все возможности редактора Quill.</p><ul><li>Жирный текст</li><li><em>Курсив</em></li><li><u>Подчёркнутый</u></li><li><s>Зачёркнутый</s></li></ul><p>А также <a href="https://laravel.com" target="_blank">ссылки</a> и многое другое.</p>',
            ],
            [
                'title' => 'Пост 2: Заголовки и списки',
                'content' => '<h2>Работаем с заголовками</h2><h3>Это H3</h3><h4>А это H4</h4><p>Теперь списки:</p><ol><li>Первый пункт нумерованного списка</li><li>Второй пункт</li><li>Третий с <strong>жирным</strong> текстом</li></ol><p>И маркированный:</p><ul><li>Элемент 1</li><li>Элемент 2</li><li>Элемент 3</li></ul>',
            ],
            [
                'title' => 'Пост 3: Цитаты и код',
                'content' => '<blockquote>Это красивая цитата. Она выделяется визуально и подходит для важных мыслей или высказываний.</blockquote><p>А вот пример кода:</p><pre><code class="ql-syntax" spellcheck="false">function hello() {\n    echo "Привет, мир!";\n    return true;\n}</code></pre><p>И инлайн-код: <code>echo $variable;</code></p>',
            ],
            [
                'title' => 'Пост 4: Таблицы и выравнивание (Quill не поддерживает таблицы, но покажем альтернативы)',
                'content' => '<p>Quill не имеет встроенных таблиц, но можно использовать:</p><ul><li>Markdown-подобные списки</li><li>Или просто текст с отступами</li></ul><p>Пример "таблицы" через списки:</p><ul><li><strong>Имя:</strong> Алексей</li><li><strong>Возраст:</strong> 30</li><li><strong>Город:</strong> Москва</li></ul>',
            ],
            [
                'title' => 'Пост 5: Ссылки и медиа',
                'content' => '<p>Полезные ссылки:</p><ul><li><a href="https://livewire.laravel.com" target="_blank">Официальная документация Livewire</a></li><li><a href="https://alpinejs.dev" target="_blank">Alpine.js</a></li><li><a href="https://quilljs.com" target="_blank">Quill редактор</a></li></ul><p>В будущем можно добавить вставку изображений и видео.</p>',
            ],
        ];

        // Очищаем таблицу перед заполнением (опционально)
        Post::truncate();

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}