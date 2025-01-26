@extends('background.app')

@section('title', $post->title)

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-4">{{ $post->title }}</h1>
        @if ($post->photo_path)
            <img src="{{ asset('storage/' . $post->photo_path) }}" alt="{{ $post->title }}" class="w-full h-64 object-cover rounded mb-4">
        @endif
        <p class="text-gray-300 mb-4">{{ $post->body }}</p>
        <div class="text-gray-500 text-sm">
            <p>Автор: {{ $post->user->name }}</p>
            <p>Опубликовано: {{ $post->created_at->format('d.m.Y H:i') }}</p>
        </div>
    </div>
</div>
@endsection
