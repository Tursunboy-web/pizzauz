@extends('layouts.app') {{-- Предполагается, что у вас есть общий layout для админки --}}

@section('title', 'Настройки уведомлений')

@section('content')
<div class="container-fluid">
    <h1 class="mt-4 mb-4">Настройки уведомлений</h1>

    <div class="mb-4 shadow card">
        <div class="py-3 card-header">
            <h6 class="m-0 font-weight-bold text-primary">Управление уведомлениями Telegram</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.notifications.save') }}" method="POST">
                @csrf

                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="notificationsEnabled" name="notifications_enabled" {{ $notifications_enabled ? 'checked' : '' }}>
                        <label class="custom-control-label" for="notificationsEnabled">Включить уведомления Telegram</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="telegramBotToken">Токен Telegram бота</label>
                    <input type="text" class="form-control" id="telegramBotToken" name="telegram_bot_token" value="{{ old('telegram_bot_token', $telegram_bot_token ?? '') }}" placeholder="Введите токен вашего Telegram бота">
                    @error('telegram_bot_token')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telegramChatId">ID чата Telegram</label>
                    <input type="text" class="form-control" id="telegramChatId" name="telegram_chat_id" value="{{ old('telegram_chat_id', $telegram_chat_id ?? '') }}" placeholder="Введите ID чата или канала Telegram">
                    @error('telegram_chat_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Сохранить настройки</button>
            </form>
        </div>
    </div>
</div>
@endsection
