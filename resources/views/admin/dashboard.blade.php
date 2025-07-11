@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать в админку!</h1>
    <div class="row mt-4">
        <!-- Пример карточек -->
        <div class="col-md-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Всего заказов</h5>
                    <p class="card-text fs-3">{{ $orderCount }}</p>
                </div>
            </div>
        </div>
        <!-- Остальные блоки аналогично -->
    </div>
@endsection
