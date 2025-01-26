@extends('background.app')

@section('title', 'Добавить новость')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-4">Добавить новость</h1>

        <!-- Уведомления об ошибках -->
        @if ($errors->any())
            <div class="bg-red-500 text-white px-4 py-2 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Форма -->
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Заголовок -->
            <div>
                <label class="block text-gray-300">Заголовок</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <!-- Текст -->
            <div>
                <label class="block text-gray-300">Текст</label>
                <textarea name="body" rows="6" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">{{ old('body') }}</textarea>
            </div>

            <!-- Фото -->
            <div>
                <label class="block text-gray-300">Фото</label>
                <input type="file" name="photo" class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <!-- Сохранить -->
            <div>
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Добавить новость
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
