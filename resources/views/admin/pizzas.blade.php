@extends('layouts.app')

@section('content')
  <h1>Меню пиццы</h1>
  <a href="{{ route('admin.pizzas.create') }}" class="btn btn-success mb-3">+ Добавить пиццу</a>

  <div class="row">
    @foreach($pizzas as $pizza)
      <div class="col-md-4">
        <div class="card mb-3">
          @if($pizza->image)
            <img src="{{ asset('storage/' . $pizza->image) }}" class="card-img-top" style="max-height: 200px; object-fit: cover;">
          @endif
          <div class="card-body">
            <h5>{{ $pizza->name }}</h5>
            <p>{{ Str::limit($pizza->description, 80) }}</p>
            <p><strong>{{ $pizza->price }} сум</strong></p>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <form action="{{ route('admin.pizzas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Название</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Описание</label>
        <textarea name="description" class="form-control" rows="3" required></textarea>
    </div>

    <div class="mb-3">
        <label>Цена (в сумах)</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Изображение</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Сохранить</button>
</form>
<form action="{{ route('admin.pizzas.destroy', $pizza->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Удалить эту пиццу?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger">Удалить</button>
</form>


@endsection
