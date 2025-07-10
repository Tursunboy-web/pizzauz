<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
