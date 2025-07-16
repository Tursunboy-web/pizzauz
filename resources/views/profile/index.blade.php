@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
<div class="container py-4">
    <h1>Мои заказы</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Новый заказ</a>

    @if($orders->count())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Пицца</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->pizza->name ?? 'Неизвестно' }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>
                            <span class="badge
                                @if($order->status === 'доставлен') bg-success
                                @elseif($order->status === 'готовится') bg-warning
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary">Редактировать</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Удалить заказ?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}
    @else
        <p>У вас пока нет заказов.</p>
    @endif
</div>
@endsection
