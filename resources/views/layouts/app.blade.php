<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PizzaUz')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #fff;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>
<body class="{{ session('theme', 'light') == 'dark' ? 'dark-mode' : '' }}">

<!-- Навигационная панель сверху -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">🍕 PizzaUz</a>

        <form class="d-flex" action="{{ route('home') }}" method="GET">
            <input class="form-control me-2" type="search" name="search" placeholder="Поиск пиццы" value="{{ request('search') }}">
            <button class="btn btn-outline-light" type="submit">🔍</button>
        </form>

        <div class="d-flex align-items-center">
            <form method="POST" action="{{ route('toggle.theme') }}" class="me-2">
                @csrf
                <button class="btn btn-sm btn-outline-warning">🌙/☀️</button>
            </form>

            <a href="?lang=uz" class="btn btn-sm btn-outline-light me-1">UZ</a>
            <a href="?lang=ru" class="btn btn-sm btn-outline-light me-3">RU</a>

            @auth
                <span class="text-white me-2">👤 {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">🚪 Выйти</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light me-2">🔐 Вход</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-outline-light">📝 Регистрация</a>
            @endauth
        </div>
    </div>
</nav>

<div class="d-flex">
    @auth
        @if(Auth::user()->role === 'admin')
        <!-- Сайдбар слева только для админов -->
        <div class="sidebar">
            <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
            <a href="{{ route('admin.orders') }}">🛒 Заказы</a>
            <a href="{{ route('admin.analytics') }}">📈 Аналитика</a>
            <a href="{{ route('admin.settings') }}">⚙️ Настройки</a>
            <a href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
        </div>
        @endif
    @endauth

    <!-- Основной контент -->
    <div class="content flex-grow-1">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
