@extends('layouts.app')

@section('title', '📊 Аналитика')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">📈 Аналитика</h1>

    {{-- Карточки --}}
    <div class="row">
    <x-dashboard-card title="Всего заказов" count="{{ $orderCount }}" icon="fas fa-box" color="primary" />
    <x-dashboard-card title="Всего пицц" count="{{ $pizzaCount }}" icon="fas fa-pizza-slice" color="success" />
    <x-dashboard-card title="Пользователи" count="{{ $userCount }}" icon="fas fa-users" color="info" />
</div>


    {{-- График заказов --}}
    <div class="card mt-4 shadow">
        <div class="card-header bg-gradient-primary text-white">📆 Заказы за 7 дней</div>
        <div class="card-body">
            <canvas id="ordersChart" height="100"></canvas>
        </div>
    </div>

    {{-- Последние заказы --}}
    <div class="card mt-4 shadow">
        <div class="card-header bg-gradient-secondary text-white">🕒 Последние заказы</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Клиент</th>
                        <th>Пицца</th>
                        <th>Дата</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->pizza->name ?? '—' }}</td>
                            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <span class="badge
                                    @if($order->status == 'доставлен') bg-success
                                    @elseif($order->status == 'готовится') bg-warning
                                    @else bg-secondary @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Подключаем Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Заказы',
                data: @json($ordersPerDay),
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endsection
