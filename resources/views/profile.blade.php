@extends('layouts.app')

@section('title', 'Личный кабинет')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">👤 Личный кабинет</h2>

    <div class="mb-4 card">
        <div class="card-body">
            <h5>Имя: {{ Auth::user()->name }}</h5>
            <p>Email: {{ Auth::user()->email }}</p>
        </div>
    </div>

    <h4>🛒 Мои заказы</h4>
    @forelse($orders as $order)
        <div class="mb-3 card">
            <div class="card-body">
                <h5>{{ $order->pizza->name }}</h5>
                <p><strong>Статус:</strong>
                    @switch($order->status)
                        @case('pending') <span class="badge bg-warning">Ожидает</span> @break
                        @case('preparing') <span class="badge bg-primary">Готовится</span> @break
                        @case('on_way') <span class="badge bg-info">В пути</span> @break
                        @case('delivered') <span class="badge bg-success">Доставлено</span> @break
                        @default <span class="badge bg-secondary">Неизвестно</span>
                    @endswitch
                </p>
                <p><strong>Цена:</strong> {{ $order->pizza->price }} сум</p>
                <p><strong>Адрес:</strong> {{ $order->address }}</p>
                <p><strong>Телефон:</strong> {{ $order->phone }}</p>
                <p><small>Оформлен: {{ $order->created_at->format('d.m.Y H:i') }}</small></p>
            </div>
        </div>
    @empty
        <p>У вас пока нет заказов.</p>
    @endforelse
</div>
@endsection
