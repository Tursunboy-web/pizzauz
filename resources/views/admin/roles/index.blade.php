@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Роли</h2>
    <a href="{{ route('admin.roles.create') }}" class="mb-3 btn btn-primary">Создать роль</a>

    <table class="table">
        <thead>
            <tr>
                <th>Название</th>
                <th>Права</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $perm)
                        <span class="badge bg-secondary">{{ $perm->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-sm btn-warning">Изменить</a>
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
