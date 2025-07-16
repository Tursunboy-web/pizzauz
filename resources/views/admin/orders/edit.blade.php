@extends('layouts.app')

@section('title', 'Редактировать заказ')

@section('content')
<div class="container">
    <h1 class="mb-4">Редактировать заказ #{{ $order->id }}</h1>

    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Имя клиента</label>
            <input type="text" class="form-control" value="{{ $order->name }}" disabled>
        </div>

        <div class="form-group">
            <label>Телефон</label>
            <input type="text" class="form-control" value="{{ $order->phone }}" disabled>
        </div>

        <div class="form-group">
            <label>Пицца</label>
            <input type="text" class="form-control" value="{{ $order->pizza->name ?? 'Неизвестно' }}" disabled>
        </div>

        <div class="form-group">
            <label for="status">Статус</label>
            <select name="status" class="form-control" required>
                <option value="в ожидании" {{ $order->status == 'в ожидании' ? 'selected' : '' }}>🕒 В ожидании</option>
                <option value="готовится" {{ $order->status == 'готовится' ? 'selected' : '' }}>👨‍🍳 Готовится</option>
                <option value="в пути" {{ $order->status == 'в пути' ? 'selected' : '' }}>🚚 В пути</option>
                <option value="доставлен" {{ $order->status == 'доставлен' ? 'selected' : '' }}>✅ Доставлен</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">💾 Сохранить</button>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary mt-3">← Назад</a>
    </form>
</div>
@endsection
