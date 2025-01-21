<?php

namespace App\Http\Controllers;

use App\Models\Post; // Подключите модель
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Получаем посты из базы с пагинацией (6 постов на страницу)
        $posts = Post::with('user')->latest()->paginate(9);

        // Передаем посты в представление
        return view('background.app', compact('posts'));
    }
}
