@extends('background.app')

@section('title', $title)

@section('content')
<div class="container mx-auto px-4 py-10">
    <h1 class="text-4xl font-bold text-white mb-6">Создать новость</h1>
    <form action="{{ route('news.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-white">Заголовок</label>
            <input type="text" id="title" name="title" class="w-full bg-gray-800 text-white rounded px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label for="body" class="block text-white">Текст</label>
            <textarea id="body" name="body" class="w-full bg-gray-800 text-white rounded px-4 py-2" rows="5" required></textarea>
        </div>
        <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
            Сохранить
        </button>
    </form>
</div>
@endsection
