@extends('admin.layout')

@section('title', 'Заказы')

@section('content')
    <h1>Все заказы</h1>
    <!-- Таблица заказов -->
    <table>
        <thead>
            <tr>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Адрес</th>
                <th>Пицца</th>
                <th>Дата</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->pizza->name ?? '-' }}</td>
                    <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
