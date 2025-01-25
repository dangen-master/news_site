<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;


class PostController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'date_desc');
        $tagId = $request->get('tag');
        $authorId = $request->get('author');
        $perPage = $request->get('per_page', 10); // Количество постов на страницу

        $orderBy = match ($sort) {
            'date_asc' => ['created_at', 'asc'],
            'date_desc' => ['created_at', 'desc'],
            default => ['created_at', 'desc'],
        };

        $query = Post::orderBy($orderBy[0], $orderBy[1]);

        if ($tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('tags.id', $tagId);
            });
        }

        if ($authorId) {
            $query->where('user_id', $authorId);
        }

        $posts = $query->paginate($perPage);

        return view('news.index', [
            'title' => 'Новости',
            'posts' => $posts,
            'tags' => Tag::all(),
            'authors' => User::all(), // Список всех авторов
        ]);
    }




    public function create()
    {
        return view('post-create', [
            'title' => 'Добавление поста',
            'tags' => Tag::all(),
        ]);
    }

    public function post(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:8',
            'body' => 'required|min:8',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $title = $data['title'];
        $body = $data['body'];
        $slug = Str::slug($title);

        $post = Post::create([
        'title' => $title,
        'body' => $body,
        'slug' => $slug,
        'user_id' => $request->user()->id
        ]);

        if (isset($data['tags'])) {
        $post->tags()->sync($data['tags']);
        }

       return redirect()->back()->with('success', 'Пост успешно создан!');
    }

    public function update(Request $request, Post $post)
    {
        return view('post-update', [
            'title' => 'Обновление поста ' . $post->title,
            'post' => $post,
            'tags' => Tag::all(),
            'postTags' => $post->tags
        ]);
    }

    public function updateSuccess(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'sometimes|min:8',
            'body' => 'sometimes|min:8'
        ]);

        $title = $data['title'];
        $body = $data['body'];
        $slug = Str::slug($title);

        $post->update([
            'title' => $title,
            'body' => $body,
            'slug' => $slug,
        ]);

        return redirect()->back()->with('success', 'Пост успешно обновлён!');
    }
}
