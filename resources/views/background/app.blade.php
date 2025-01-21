<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Новости')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-color: #1B1B1B;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(27, 27, 27, 0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 10;
        }

        .header a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .header a:hover {
            background-color: #333;
        }

        /* Видео на фоне */
        .video-bg {
            position: fixed;
            top: 40%;
            left: 70%;
            transform: translate(-50%, -50%);
            width: auto;
            height: 40vh;
            object-fit: cover;
            z-index: -1;
        }

        /* Контейнер для градиентных шаров */
        .gradient-balls {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            pointer-events: none;
        }

        .ball {
            position: absolute;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.6;
            animation: float 10s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            50% { transform: translateY(-20px) translateX(20px); }
        }

        .ball:nth-child(1) { width: 300px; height: 300px; background: linear-gradient(135deg, #ff0080, #ff6600); top: 10%; left: 20%; }
        .ball:nth-child(2) { width: 400px; height: 400px; background: linear-gradient(135deg, #00ffcc, #0080ff); top: 80%; left: 70%; }
        .ball:nth-child(3) { width: 250px; height: 250px; background: linear-gradient(135deg, #ff6600, #ff0080); top: 80%; left: 10%; }
        .ball:nth-child(4) { width: 350px; height: 500px; background: linear-gradient(135deg, #8000ff, #00ffcc); top: 75%; left: 50%; }
    </style>
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
        <div class="logo">
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
