@extends('layouts.app')

@section('content')
  <h1>Добавить пиццу</h1>

  <form action="{{ route('admin.pizzas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label>Название</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Описание</label>
      <textarea name="description" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label>Цена (в сумах)</label>
      <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Фото (необязательно)</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-danger">Сохранить</button>
  </form>
@endsection
