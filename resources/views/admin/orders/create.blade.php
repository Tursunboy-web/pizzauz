@extends('layouts.app')

@section('title', 'Создать заказ')

@section('content')
<div class="container py-4">
    <h1>Создать новый заказ</h1>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pizza_id" class="form-label">Выберите пиццу</label>
            <select name="pizza_id" id="pizza_id" class="form-select" required>
                <option value="">-- Выберите пиццу --</option>
                @foreach ($pizzas as $pizza)
                    <option value="{{ $pizza->id }}">{{ $pizza->name }} ({{ $pizza->price }} ₽)</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Адрес доставки</label>
            <input type="text" name="address" id="address" class="form-control" required value="{{ old('address') }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" id="phone" class="form-control" required value="{{ old('phone') }}">
        </div>

        <button type="submit" class="btn btn-primary">Отправить заказ</button>
    </form>
</div>
@endsection
