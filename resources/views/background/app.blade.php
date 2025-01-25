<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title', 'Новости')</title>
</head>
<body class="text-white">
    <!-- Градиентные шары -->
    <div class="gradient-balls">
        <div class="ball"></div>
        <div class="ball"></div>
        <div class="ball"></div>
        <div class="ball"></div>
    </div>

    <!-- Видео фон -->
    <video class="video-bg" autoplay muted loop>
        <source src="{{ asset("storage/videos/bubbles.mp4") }}" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <!-- Header -->
    <header class="header">
        <div class="logo text-amber-200">
            <a href="">Главная</a>
        </div>
        <div class="flex items-center space-x-4">
            @guest
                <!-- Гость -->
                <a href="{{ route('login') }}">Войти</a>
                <a href="{{ route('register') }}">Регистрация</a>
            @endauth
            @auth
            <a
            href="{{ route('profile.edit') }}"
            class="flex items-center space-x-2 text-blue-500 hover:text-blue-700 font-semibold"
            >
            {{-- <img
                src="{{ auth()->user()->getAvatarUrlAttribute() }}"
                alt="Аватар пользователя"
                class="w-8 h-8 rounded-full"
            > --}}
            <span>Профиль</span>
            </a>
        <!-- Кнопка Выйти -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button
                type="submit"
                class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition"
            >
                <span class="flex items-center space-x-2 text-blue-500 hover:text-blue-700 font-semibold">Выйти</span>
            </button>
        </form>
                <!-- Авторизованный пользователь -->

            @endguest
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-8 bg-gray-900 text-center">
        <p class="text-gray-400">
            &copy; 2025 Новости. Все права защищены.
        </p>
    </footer>
</body>
</html>
