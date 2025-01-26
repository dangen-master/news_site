<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новости')</title>
</head>
<body class="text-white bg-[#1B1B1B] flex flex-col min-h-screen overflow-x-hidden">
    <!-- Градиентные шары -->
    <div class="fixed inset-0 z-[-2] pointer-events-none">
        <div class="absolute w-[300px] h-[300px] rounded-full blur-[120px] opacity-60 bg-gradient-to-r from-[#ff0080] to-[#ff6600] top-[10%] left-[20%] animate-float"></div>
        <div class="absolute w-[400px] h-[400px] rounded-full blur-[120px] opacity-60 bg-gradient-to-r from-[#00ffcc] to-[#0080ff] top-[80%] left-[70%] animate-float"></div>
        <div class="absolute w-[250px] h-[250px] rounded-full blur-[120px] opacity-60 bg-gradient-to-r from-[#ff6600] to-[#ff0080] top-[80%] left-[10%] animate-float"></div>
        <div class="absolute w-[350px] h-[500px] rounded-full blur-[120px] opacity-60 bg-gradient-to-r from-[#8000ff] to-[#00ffcc] top-[75%] left-[50%] animate-float"></div>
    </div>

    <!-- Видео фон -->
    <video class="fixed top-[40%] left-[70%] transform -translate-x-1/2 -translate-y-1/2 w-auto h-[40vh] object-cover z-[-1]" autoplay muted loop>
        <source src="{{ asset('storage/videos/bubbles.mp4') }}" type="video/mp4">
        Ваш браузер не поддерживает видео.
    </video>

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full bg-[#1B1B1B]/90 flex justify-between items-center p-4 z-10">
        <div class="logo">
            <a href="/" class="text-white text-lg px-4 py-2 rounded hover:bg-gray-800">Главная</a>
        </div>
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}" class="text-white text-lg px-4 py-2 rounded hover:bg-gray-800">Войти</a>
                <a href="{{ route('register') }}" class="text-white text-lg px-4 py-2 rounded hover:bg-gray-800">Регистрация</a>
            @endauth
            @auth
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 text-blue-500 hover:text-blue-700 font-semibold">
                @if (auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Аватар" class="w-8 h-8 rounded-full">
                @else
                    <img src="{{ asset('default-avatar.png') }}" alt="Аватар" class="w-8 h-8 rounded-full">
                @endif
                <span>Профиль</span>
            </a>
            <!-- Кнопка Выйти -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg hover:bg-red-600 transition">
                    Выйти
                </button>
            </form>
            @endguest
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-6 py-10 flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-8 bg-gray-900 text-center">
        <p class="text-gray-400">
            &copy; 2025 Новости. Все права защищены.
        </p>
    </footer>

    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(20px); }
        }
        .animate-float {
            animation: float 10s ease-in-out infinite;
        }
    </style>
</body>
</html>
