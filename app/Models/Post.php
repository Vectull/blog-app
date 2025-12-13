<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Добавьте эту строку — разрешаем массовое присваивание для title и content
    protected $fillable = ['title', 'content'];
}