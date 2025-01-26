<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Метод для отображения списка постов
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'date_desc');
        $authorId = $request->get('author');
        $perPage = $request->get('per_page', 10); // Количество постов на странице

        $orderBy = match ($sort) {
            'date_asc' => ['created_at', 'asc'],
            'date_desc' => ['created_at', 'desc'],
            default => ['created_at', 'desc'],
        };

        $query = Post::orderBy($orderBy[0], $orderBy[1]);

        if ($authorId) {
            $query->where('user_id', $authorId);
        }

        $posts = $query->paginate($perPage);

        return view('news.index', [
            'title' => 'Новости',
            'posts' => $posts,
            'authors' => User::all(), // Список всех авторов
        ]);
    }

    // Метод для отображения формы создания поста
    public function create()
    {
        return view('news.create', [
            'title' => 'Создать новость',
        ]);
    }

    // Метод для сохранения нового поста
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id', // Выбор автора
        ]);

        Post::create($validated);

        return redirect()->route('news.index')->with('success', 'Новость успешно создана!');
    }

    // Метод для отображения конкретного поста
    public function show(Post $post)
    {
        return view('news.show', [
            'post' => $post,
        ]);
    }

    // Метод для отображения формы редактирования поста
    public function edit(Post $post)
    {
        return view('news.edit', [
            'title' => 'Редактирование поста',
            'post' => $post,
            'authors' => User::all(),
        ]);
    }

    // Метод для обновления поста
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update($validated);

        return redirect()->route('news.index')->with('success', 'Новость успешно обновлена!');
    }

    // Метод для удаления поста
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('news.index')->with('success', 'Новость успешно удалена!');
    }
}
