<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'phone', 'address', 'pizza_id'];

    public function pizza()
    {
        return $this->belongsTo(Pizza::class);
    }
}
