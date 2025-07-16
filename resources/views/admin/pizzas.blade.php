@extends('layouts.app')

@section('content')
  <h1>Меню пиццы</h1>
  <a href="{{ route('admin.pizzas.create') }}" class="mb-3 btn btn-success">+ Добавить пиццу</a>

  <div class="row">
    @foreach($pizzas as $pizza)
      <div class="col-md-4">
        <div class="mb-3 card">
          @if($pizza->image)
            <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
          @endif
          <div class="card-body">
            <h5>{{ $pizza->name }}</h5>
            <p>{{ Str::limit($pizza->description, 80) }}</p>
            <p><strong>{{ $pizza->price }} сум</strong></p>

            <a href="{{ route('admin.pizzas.edit', $pizza->id) }}" class="btn btn-sm btn-primary">✏️ Редактировать</a>
            <form action="{{ route('admin.pizzas.destroy', $pizza->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Удалить эту пиццу?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">🗑️ Удалить</button>
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
