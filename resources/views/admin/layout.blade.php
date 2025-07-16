<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Админка')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
            width: 220px;
        }
        .sidebar a, .sidebar form button {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border: none;
            background: none;
            text-align: left;
            width: 100%;
        }
        .sidebar a:hover, .sidebar form button:hover {
            background-color: #495057;
        }
    </style>
</head>
<!-- В layout.blade.php перед закрывающим </head> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<body>
<div class="d-flex">
    <!-- Sidebar -->
    @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="sidebar">
    <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">📊 Главная</a>
    <a class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">🛒 Заказы</a>
    <a class="{{ request()->routeIs('admin.pizzas') ? 'active' : '' }}" href="{{ route('admin.pizzas') }}">🍕 Все пиццы</a>
    <a class="{{ request()->routeIs('admin.pizzas.create') ? 'active' : '' }}" href="{{ route('admin.pizzas.create') }}">➕ Добавить пиццу</a>
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

    <!-- Main Content -->
    <div class="p-4 flex-grow-1 w-100">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
