@extends('layouts.app')

@section('title', 'Добавить пиццу')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Добавить новую пиццу</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ошибки при сохранении:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>🔸 {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pizzas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">🍕 Название пиццы</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">📝 Описание</label>
            <textarea name="description" rows="3" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">💰 Цена (UZS)</label>
            <input type="number" name="price" step="0.01" value="{{ old('price') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">📷 Фото пиццы</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">✅ Сохранить пиццу</button>
        <a href="{{ route('admin.pizzas') }}" class="btn btn-secondary">↩️ Назад</a>
    </form>
</div>
@endsection
