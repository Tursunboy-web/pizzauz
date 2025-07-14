<?php

// app/Http/Controllers/Admin/AdminController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
 public function dashboard()
{
        return view('admin.dashboard', [
        'orderCount' => Order::count(),
        'pizzaCount' => Pizza::count(),
        'userCount'  => User::count(),
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
    return view('admin.settings', [
        'admin_email' => Setting::get('admin_email'),
        'site_name' => Setting::get('site_name'),
        'notifications' => Setting::get('notifications', 'off'),
    ]);
}

    public function banners()
    {
        return view('admin.banners');
    }

    public function saveSettings(Request $request)
{
    Setting::set('admin_email', $request->admin_email);
    Setting::set('site_name', $request->site_name);
    Setting::set('notifications', $request->has('notifications') ? 'on' : 'off');

    return back()->with('success', 'Настройки сохранены!');
}
}
