@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container mx-auto px-4">
    <header class="text-center mb-6">
        <h1 class="text-4xl font-bold text-white mb-4">Главная страница</h1>
        <p class="text-xl text-gray-300">Добро пожаловать на наш сайт!</p>
    </header>
    @if ($posts->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-semibold text-white mb-2">{{ $post->title }}</h2>
                    <p class="text-gray-400 mb-4">{{ \Illuminate\Support\Str::limit($post->body, 100, '...') }}</p>
                    <p class="text-gray-500 text-sm">Автор: {{ $post->user->name }}</p>
                    <p class="text-gray-500 text-sm">Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}</p>
                    <a href="" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 mt-4 inline-block">
                        Читать полностью
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-400 text-center">Посты пока не добавлены.</p>
    @endif
</div>
@endsection
