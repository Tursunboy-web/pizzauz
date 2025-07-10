@extends('layouts.app')

@section('content')
  <h1 class="mb-4">Меню</h1>
  <div class="row">
    @foreach($pizzas as $pizza)
      <div class="col-md-4">
        <div class="card mb-4">
          @if($pizza->image)
            <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" alt="{{ $pizza->name }}">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $pizza->name }}</h5>
            <p class="card-text">{{ Str::limit($pizza->description, 80) }}</p>
            <p><strong>{{ $pizza->price }} сум</strong></p>
            <a href="{{ route('pizza.show', $pizza->id) }}" class="btn btn-danger">Подробнее</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
