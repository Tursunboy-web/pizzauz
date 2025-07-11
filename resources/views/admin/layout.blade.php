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
    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4>🍕 PizzaUz</h4>
        <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
        <a href="{{ route('admin.orders') }}">🛒 Заказы</a>
        <a href="{{ route('admin.analytics') }}">📈 Аналитика</a>
        <a href="{{ route('admin.settings') }}">⚙️ Настройки</a>
        <a href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-sm btn-danger">🚪 Выйти</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="p-4 flex-grow-1">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS (по желанию) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
