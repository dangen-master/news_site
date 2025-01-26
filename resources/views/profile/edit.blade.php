@extends('background.app')

@section('title', 'Редактировать профиль')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-3xl font-bold text-white mb-4">Редактировать профиль</h1>

        <!-- Уведомления -->
        @if (session('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Форма редактирования профиля -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Текущий аватар -->
            <div class="mb-4">
                <label class="block text-gray-300 mb-2">Текущая фотография</label>
                <img src="{{ $user->getAvatarUrl() }}" alt="Аватар" class="w-32 h-32 rounded-full mb-4 object-cover">
            </div>

            <!-- Загрузка новой аватарки -->
            <div>
                <label class="block text-gray-300 mb-2">Загрузить новую фотографию</label>
                <input type="file" name="avatar" class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <!-- Никнейм -->
            <div>
                <label class="block text-gray-300">Никнейм</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <!-- Роль -->
            <div>
                <label class="block text-gray-300">Роль</label>
                <input type="text" value="{{ $user->role->name ?? 'Роль не указана' }}" disabled class="bg-gray-700 text-gray-400 rounded px-4 py-2 w-full">
            </div>            

            <!-- Email -->
            <div>
                <label class="block text-gray-300">Email</label>
                <input type="email" value="{{ $user->email }}" disabled class="bg-gray-700 text-gray-400 rounded px-4 py-2 w-full">
            </div>

            <!-- Сохранить изменения -->
            <div>
                <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">
                    Сохранить изменения
                </button>
            </div>
        </form>

        <!-- Форма смены пароля -->
        <h2 class="text-2xl font-bold text-white mt-8 mb-4">Изменить пароль</h2>
        <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-300">Текущий пароль</label>
                <input type="password" name="current_password" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <div>
                <label class="block text-gray-300">Новый пароль</label>
                <input type="password" name="password" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <div>
                <label class="block text-gray-300">Подтвердить новый пароль</label>
                <input type="password" name="password_confirmation" required class="bg-gray-700 text-white rounded px-4 py-2 w-full">
            </div>

            <div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Изменить пароль
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
