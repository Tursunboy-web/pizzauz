@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <h2 class="mb-4">🍕 Наше меню пиццы</h2>
  <div class="row">
    @foreach($pizzas as $pizza)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          @if($pizza->image)
            <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $pizza->name }}</h5>
            <p class="card-text">{{ $pizza->description }}</p>
            <p><strong>{{ $pizza->price }} сум</strong></p>
            <a href="{{ route('pizza.show', $pizza->id) }}" class="btn btn-sm btn-primary">Подробнее</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
