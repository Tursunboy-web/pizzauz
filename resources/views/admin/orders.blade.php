@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">📦 Все заказы</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Заказа</th>
                    <th>Клиент</th>
                    <th>Телефон</th>
                    <th>Адрес</th>
                    <th>Пицца</th>
                    <th>Время заказа</th>
                    <th>Статус</th>
                    <th>Действия</th>
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
                        <td>
                            <span style="color:
                                {{ $order->status === 'доставлен' ? 'green' :
                                   ($order->status === 'готовится' ? 'orange' : 'gray') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                          <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-outline-primary">✏️</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Удалить заказ?')">
                                    🗑️
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }}
</div>
<span class="badge
    {{ $order->status === 'доставлен' ? 'bg-success' :
       ($order->status === 'готовится' ? 'bg-warning text-dark' : 'bg-secondary') }}">
    {{ ucfirst($order->status) }}
</span>

@endsection
