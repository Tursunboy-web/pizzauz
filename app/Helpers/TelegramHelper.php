<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;

class TelegramHelper
{
    public static function send($message)
    {
        $settings = Setting::first();
        if (!$settings || !$settings->telegram_bot_token || !$settings->telegram_chat_id) return;

        $url = "https://api.telegram.org/bot{$settings->telegram_bot_token}/sendMessage";
        Http::post($url, [
            'chat_id' => $settings->telegram_chat_id,
            'text' => $message
        ]);
    }
}
