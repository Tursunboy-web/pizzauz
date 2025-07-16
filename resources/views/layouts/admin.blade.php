<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PizzaUz')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body.dark-mode { background-color: #121212; color: #fff; }

        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 220px;
            height: calc(100vh - 56px);
            background-color: #343a40;
            overflow-y: auto;
            color: white;
            z-index: 1000;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: 0.2s;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
        }

        .sidebar .logout-btn {
            background: none;
            border: none;
            padding: 12px 20px;
            color: white;
            text-align: left;
            width: 100%;
        }

        .sidebar .logout-btn:hover {
            background-color: #dc3545;
        }

        .content {
            padding: 20px;
        }

        .with-sidebar .content {
            margin-left: 220px;
        }
    </style>
</head>
<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">

@php
    $isAdmin = Auth::check() && Auth::user()->hasRole('admin');
@endphp

<!-- Навбар -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">🍕 PizzaUz</a>

        <form class="d-flex me-auto" action="{{ route('home') }}" method="GET">
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

<!-- Страница -->
<div class="{{ $isAdmin ? 'with-sidebar' : '' }}">
    @if($isAdmin)
        <div class="sidebar">
            <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">📊 Главная</a>
            <a class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">🛒 Заказы</a>
            <a class="{{ request()->routeIs('admin.pizzas*') ? 'active' : '' }}" href="{{ route('admin.pizzas') }}">🍕 Пиццы</a>
            <a class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}" href="{{ route('admin.analytics') }}">📈 Аналитика</a>
            <a class="{{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">⚙️ Настройки</a>
            <a class="{{ request()->routeIs('admin.banners') ? 'active' : '' }}" href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
            <a class="{{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">👮 Роли и доступ</a>

            <form action="{{ route('logout') }}" method="POST" style="padding: 10px;">
                @csrf
                <button type="submit" class="btn btn-link logout-btn">🚪 Выйти</button>
            </form>
        </div>
    @endif

    <div class="content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
