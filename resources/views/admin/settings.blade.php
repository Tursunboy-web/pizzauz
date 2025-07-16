@extends('layouts.app')

@section('title', 'Настройки')

@section('content')
<div class="container mt-4">
    <h2>⚙️ Настройки сайта</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

   <form action="{{ route('admin.settings.save') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Telegram Bot Token</label>
        <input type="text" name="telegram_bot_token" class="form-control" value="{{ $settings->telegram_bot_token ?? '' }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Telegram Chat ID</label>
        <input type="text" name="telegram_chat_id" class="form-control" value="{{ $settings->telegram_chat_id ?? '' }}">
    </div>

    <button class="btn btn-primary">💾 Сохранить</button>
</form>

</div>
@endsection
