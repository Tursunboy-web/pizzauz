<?php

// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
 public function dashboard()
{
    return view('admin.dashboard', [
        'orderCount' => \App\Models\Order::count(),
        'pizzaCount' => \App\Models\Pizza::count(),
        'userCount'  => \App\Models\User::count(),
    ]);
}



  public function orders() {
    $orders = Order::with('pizza')->latest()->get();
    return view('admin.orders.index', compact('orders'));
}


   public function analytics()
{
    return view('admin.analytics', [
        'orderCount' => Order::count(),
        'pizzaCount' => Pizza::count(),
        'userCount'  => User::count(),
    ]);
}

    public function settings()
    {
        return view('admin.settings');
    }

    public function banners()
    {
        return view('admin.banners');
    }
}
