@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Создать роль</h2>

    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Название</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Права</label><br>
            @foreach($permissions as $perm)
                <label><input type="checkbox" name="permissions[]" value="{{ $perm->id }}"> {{ $perm->name }}</label><br>
            @endforeach
        </div>

        <button class="btn btn-success">Сохранить</button>
    </form>
</div>
@endsection
