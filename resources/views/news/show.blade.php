@extends('background.app')

@section('title', $post->title)

@section('content')
<div class="bg-gray-800 rounded-lg shadow-lg p-6 mx-auto max-w-4xl">
    <h1 class="text-4xl font-bold text-white mb-4">{{ $post->title }}</h1>
    @if ($post->photo_path)
        <img src="{{ asset('storage/' . $post->photo_path) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded mb-4">
    @endif
    <p class="text-gray-400 mb-4">{{ $post->body }}</p>
    <p class="text-gray-500 text-sm">Автор: {{ $post->user->name }}</p>
    <p class="text-gray-500 text-sm">Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}</p>
</div>
@endsection
