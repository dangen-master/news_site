@extends('background.app')

@section('title', $title)

@section('content')
<div class="container mx-auto px-4 py-10">
    <header class="text-center mb-6">
        <h1 class="text-4xl font-bold text-white mb-4">{{ $title }}</h1>
        <div class="flex justify-center items-center space-x-4 mb-6">
            <!-- Форма фильтров -->
            <form method="GET" class="flex space-x-4">
                <select name="tag" class="bg-gray-800 text-white px-4 py-2 rounded">
                    <option value="">Все теги</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" {{ request('tag') == $tag->id ? 'selected' : '' }}>
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <select name="author" class="bg-gray-800 text-white px-4 py-2 rounded">
                    <option value="">Все авторы</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                <select name="per_page" class="bg-gray-800 text-white px-4 py-2 rounded">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 постов</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 постов</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 постов</option>
                </select>
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Применить
                </button>
            </form>

            <!-- Кнопка "Создать новость" -->
            @auth
                <a href="{{ route('news.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Создать новость
                </a>
            @endauth
        </div>
    </header>

    @if ($posts->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                    @if ($post->photo_path)
                        <img src="{{ asset('storage/' . $post->photo_path) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded mb-4">
                    @endif
                    <h2 class="text-2xl font-semibold text-white mb-2">{{ $post->title }}</h2>
                    <p class="mb-4 ">{{ \Illuminate\Support\Str::limit($post->body, 100, '...') }}</p>
                    <div class="flex items-center space-x-2 text-gray-500 text-sm mb-2">
                        @if ($post->user->avatar)
                            <img src="{{ asset('storage/' . $post->user->avatar) }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                        @else
                            <img src="{{ asset('default-avatar.png') }}" alt="{{ $post->user->name }}" class="w-8 h-8 rounded-full">
                        @endif
                        <span>Автор: {{ $post->user->name }}</span>
                    </div>
                    <p class="text-gray-500 text-sm">Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}</p>
                    <a href="{{ route('news.show', $post) }}" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600 mt-4 inline-block">
                        Читать полностью
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @else
        <p class="text-gray-400 text-center">Новостей пока нет.</p>
    @endif
</div>
@endsection
