@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="row">
    <div class="col-md-6">
     @if($pizza->image)
    <img src="{{ asset('storage/' . $pizza->image) }}" class="img-fluid" alt="{{ $pizza->name }}">
@endif

    </div>
    <div class="col-md-6">
      <h2>{{ $pizza->name }}</h2>
      <p>{{ $pizza->description }}</p>
      <h4 class="text-danger">{{ $pizza->price }} сум</h4>

      <form action="{{ route('order.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
        <div class="mb-2">
          <input type="text" name="name" class="form-control" placeholder="Ваше имя" required>
        </div>
        <div class="mb-2">
          <input type="text" name="phone" class="form-control" placeholder="Телефон" required>
        </div>
        <div class="mb-2">
          <textarea name="address" class="form-control" placeholder="Адрес доставки" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-danger">Оформить заказ</button>
      </form>

      @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
      @endif
    </div>
  </div>
</div>
@endsection
