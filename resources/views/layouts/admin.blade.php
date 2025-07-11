<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Админка | @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body { font-family: sans-serif; background: #f8fafc; }
        .sidebar { width: 200px; background: #333; color: #fff; height: 100vh; float: left; }
        .sidebar a { color: #fff; display: block; padding: 10px; text-decoration: none; }
        .content { margin-left: 200px; padding: 20px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3 style="padding:10px;">🍕 PizzaUz</h3>
        <a href="{{ route('admin.dashboard') }}">📊 Главная</a>
        <a href="{{ route('admin.orders') }}">🛒 Заказы</a>
        <a href="{{ route('admin.analytics') }}">📈 Аналитика</a>
        <a href="{{ route('admin.settings') }}">⚙️ Настройки</a>
        <a href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
     <form action="{{ route('logout') }}" method="POST" style="padding: 10px;">
        @csrf
        <button type="submit" class="btn btn-link" style="color: #fff; background: none; border: none; cursor: pointer;">
            🚪 Выход
        </button>
    </form>

    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-link">Выйти</button>
</form>



</html>
