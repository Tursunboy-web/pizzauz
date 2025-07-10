@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">🍕 Добро пожаловать в Pizzauz</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($pizzas as $pizza)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($pizza->image)
                        <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}" style="height: 220px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $pizza->name }}</h5>
                        <p class="card-text">{{ $pizza->description }}</p>
                        <h6 class="text-danger mt-auto">{{ number_format($pizza->price, 0, ',', ' ') }} сум</h6>
                        <a href="{{ route('pizza.show', $pizza->id) }}" class="btn btn-outline-danger mt-3">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
