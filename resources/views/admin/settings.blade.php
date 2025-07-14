@extends('layouts.app')

@section('title', 'Настройки')

@section('content')
<div class="container mt-4">
    <h2>⚙️ Настройки сайта</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.settings.save') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email администратора</label>
            <input type="email" name="admin_email" class="form-control" value="{{ $admin_email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Название сайта</label>
            <input type="text" name="site_name" class="form-control" value="{{ $site_name }}">
        </div>

        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="notifications" id="notifications" {{ $notifications == 'on' ? 'checked' : '' }}>
            <label class="form-check-label" for="notifications">Включить email-уведомления</label>
        </div>

        <button type="submit" class="btn btn-primary">💾 Сохранить</button>
    </form>
</div>
@endsection
