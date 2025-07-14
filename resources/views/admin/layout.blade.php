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
<body>
<div class="d-flex">
    <!-- Sidebar -->
    @if(Auth::check() && Auth::user()->role === 'admin')
    <div class="sidebar">
        <h4 class="py-3 text-center">🍕 PizzaUz</h4>
        <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
        <a href="{{ route('admin.orders') }}">🛒 Заказы</a>
        <a href="{{ route('admin.analytics') }}">📈 Аналитика</a>
        <a href="{{ route('admin.settings') }}">⚙️ Настройки</a>
        <a href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">🚪 Выйти</button>
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
