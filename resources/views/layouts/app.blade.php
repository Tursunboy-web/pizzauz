<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'PizzaUz')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body.dark-mode { background-color: #121212; color: #fff; }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 220px;
            height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar a {
            color: white;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover { background-color: #495057; }
        .content { margin-left: 220px; padding: 0px; }
    </style>
</head>

<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">🍕 PizzaUz</a>
        <div class="d-flex align-items-center ms-auto">
            @auth
                <span class="text-white me-2">👤 {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">🚪 Выйти</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

@if(Auth::check() && Auth::user()->hasRole('admin'))
    <div class="alert alert-warning">
        Роли: {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}
    </div>

    <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
        <a href="{{ route('admin.orders') }}">🛒 Заказы</a>
        <a href="{{ route('admin.pizzas') }}">🍕 Все пиццы</a>
        <a href="{{ route('admin.pizzas.create') }}">➕ Добавить пиццу</a>
        <a href="{{ route('admin.analytics') }}">📈 Аналитика</a>
        <a href="{{ route('admin.settings') }}">⚙️ Настройки</a>
        <a href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
        <a href="{{ route('admin.roles.index') }}">👮 Роли и доступ</a>
    </div>
@endif



<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
