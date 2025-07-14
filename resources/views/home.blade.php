@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Панель управления -->
   <form method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Поиск по названию" value="{{ request('search') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="min" class="form-control" placeholder="Мин. цена" value="{{ request('min') }}">
        </div>
        <div class="col-md-2">
            <input type="number" name="max" class="form-control" placeholder="Макс. цена" value="{{ request('max') }}">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Фильтр</button>
        </div>
    </div>
</form>


    <!-- Здесь пиццы -->
    <div class="row">
        @foreach($pizzas as $pizza)
        <div class="mb-3 col-md-4">
            <div class="card">
                @if($pizza->image)
                <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $pizza->name }}</h5>
                    <p class="card-text">{{ $pizza->description }}</p>
                    <p class="text-danger fw-bold">{{ $pizza->price }} сум</p>
                    <a href="{{ route('pizza.show', $pizza->id) }}" class="btn btn-sm btn-primary">Подробнее</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
