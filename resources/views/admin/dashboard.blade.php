@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 mb-4">Добро пожаловать в админку!</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Всего заказов
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orderCount }}</div>
                    </div>
                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Всего пицц в меню
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pizzaCount }}</div>
                    </div>
                    <i class="fas fa-pizza-slice fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Всего пользователей
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                    </div>
                    <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Последние 10 заказов --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Последние 10 заказов</h6>
                </div>
                <div class="card-body">
                    @if($orders->isEmpty())
                        <p>Пока нет новых заказов.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Клиент</th>
                                        <th>Телефон</th>
                                        <th>Адрес</th>
                                        <th>Пицца</th>
                                        <th>Дата</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->pizza->name ?? 'Неизвестно' }}</td>
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- График --}}
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">График статистики</h6>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="200"></canvas>
                </div>
            </div>
        </div>

        {{-- Быстрые действия --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Быстрые действия</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-list"></i> Все заказы
                    </a>
                    <a href="{{ route('admin.pizzas') }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-pizza-slice"></i> Управление пиццами
                    </a>
                    <a href="{{ route('admin.pizzas.create') }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-plus-circle"></i> Добавить пиццу
                    </a>
                    <a href="{{ route('admin.settings') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-cog"></i> Настройки
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- Подключение Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Заказы', 'Пиццы', 'Пользователи'],
                    datasets: [{
                        label: 'Количество',
                        data: [{{ $orderCount }}, {{ $pizzaCount }}, {{ $userCount }}],
                        backgroundColor: [
                            'rgba(78, 115, 223, 0.8)',
                            'rgba(28, 200, 138, 0.8)',
                            'rgba(54, 185, 204, 0.8)'
                        ],
                        borderColor: [
                            'rgba(78, 115, 223, 1)',
                            'rgba(28, 200, 138, 1)',
                            'rgba(54, 185, 204, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        }
    </script>
@endpush
