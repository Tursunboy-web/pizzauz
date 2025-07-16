@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Редактировать роль: {{ $role->name }}</h2>

    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" class="form-control" value="{{ $role->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Права</label><br>
            @foreach($permissions as $perm)
                <label>
                    <input type="checkbox" name="permissions[]" value="{{ $perm->id }}"
                        {{ $role->permissions->contains('id', $perm->id) ? 'checked' : '' }}>
                    {{ $perm->name }}
                </label><br>
            @endforeach
        </div>

        <button class="btn btn-primary">Обновить</button>
    </form>
</div>
@endsection
