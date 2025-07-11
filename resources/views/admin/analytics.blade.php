@extends('admin.layout')

@section('title', 'Аналитика')

@section('content')
    <h1 class="text-2xl font-bold mb-6">📈 Аналитика</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Заказы -->
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold text-indigo-600">{{ $orderCount }}</div>
            <div class="mt-2 text-gray-600">Всего заказов</div>
        </div>

        <!-- Пиццы -->
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold text-green-600">{{ $pizzaCount }}</div>
            <div class="mt-2 text-gray-600">Всего пицц</div>
        </div>

        <!-- Пользователи -->
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <div class="text-4xl font-bold text-pink-600">{{ $userCount }}</div>
            <div class="mt-2 text-gray-600">Всего пользователей</div>
        </div>
    </div>
@endsection
