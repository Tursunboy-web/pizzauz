<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewOrderNotification;

class Order extends Model
{
    use Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'pizza_id'
    ];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }

    public function notifyAdmin()
    {
        Notification::route('mail', 'admin@pizzauz.uz')
            ->notify(new NewOrderNotification($this));
    }
}
