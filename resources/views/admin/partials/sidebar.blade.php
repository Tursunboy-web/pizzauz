<ul class="nav flex-column nav-pills">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">📊 Главная</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">🛒 Заказы</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.pizzas*') ? 'active' : '' }}" href="{{ route('admin.pizzas') }}">🍕 Пиццы</a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}" href="{{ route('admin.analytics') }}">📈 Аналитика</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">⚙️ Настройки</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.banners') ? 'active' : '' }}" href="{{ route('admin.banners') }}">🖼️ Баннеры</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.roles.*') || request()->routeIs('admin.permissions.*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}">👮 Роли и доступ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link text-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">🚪 Выйти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    </li>
</ul>
