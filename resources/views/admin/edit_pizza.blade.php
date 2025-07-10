@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Редактировать пиццу</h2>
    <form action="{{ route('admin.pizzas.update', $pizza->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Название</label>
            <input type="text" name="name" class="form-control" value="{{ $pizza->name }}" required>
        </div>

        <div class="mb-3">
            <label>Описание</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $pizza->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Цена</label>
            <input type="number" name="price" class="form-control" value="{{ $pizza->price }}" required>
        </div>

        <div class="mb-3">
            <label>Новое изображение</label>
            <input type="file" name="image" class="form-control">
            @if($pizza->image)
                <img src="{{ asset('storage/' . $pizza->image) }}" width="150" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>
</div>
@endsection
