<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class NewsController extends Controller
{
    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $post = new Post();
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->user_id = auth()->id();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('posts', 'public');
            $post->photo_path = $path;
        }

        $post->save();

        return redirect()->route('news.index')->with('success', 'Новость успешно добавлена!');
    }
}
