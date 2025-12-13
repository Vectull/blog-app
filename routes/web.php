<?php

use Illuminate\Support\Facades\Route;

Route::get('/posts', function () {
    return view('posts.index');
})->name('posts.index');

Route::get('/posts/{post}', function (\App\Models\Post $post) {
    return view('posts.index'); // Всегда рендерим список, модальное управляется JS/Livewire
})->name('posts.show');