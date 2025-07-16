<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Order;
use App\Models\User;
use App\Models\Setting;
use Carbon\Carbon;


class AdminController extends Controller
{
    // === 📊 Главная панель ===
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalPizzas = Pizza::count();

        $courierCount = User::role('courier')->count();
        $chefCount = User::role('chef')->count();
        $clientCount = User::role('client')->count();

        $customerCount = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['admin', 'manager', 'cook', 'courier']);
        })->count();

        return view('admin.dashboard', [
            'orderCount'    => $totalOrders,
            'pizzaCount'    => $totalPizzas,
            'userCount'     => $totalUsers,
            'courierCount'  => $courierCount,
            'chefCount'     => $chefCount,
            'clientCount'   => $clientCount > 0 ? $clientCount : $customerCount,
            'orders'        => Order::with('pizza')->latest()->take(10)->get(),
        ]);
    }

    // === 🍕 Пиццы ===
    public function pizzas()
    {
        $pizzas = Pizza::latest()->get();
        return view('admin.pizzas', compact('pizzas'));
    }

    public function createPizza()
    {
        return view('admin.pizzas_create');
    }

    public function storePizza(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pizzas', 'public');
        }

        Pizza::create($data);
        return redirect()->route('admin.pizzas')->with('success', 'Пицца успешно добавлена!');
    }

    public function editPizza(Pizza $pizza)
    {
        return view('admin.edit_pizza', compact('pizza'));
    }

    public function updatePizza(Request $request, Pizza $pizza)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pizzas', 'public');
        }

        $pizza->update($data);
        return redirect()->route('admin.pizzas')->with('success', 'Пицца обновлена!');
    }

    public function destroyPizza(Pizza $pizza)
    {
        $pizza->delete();
        return redirect()->route('admin.pizzas')->with('success', 'Пицца удалена!');
    }

    // === 📦 Заказы ===
    public function orders()
    {
        $orders = Order::with('pizza')->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    public function editOrder($id)
    {
        $order = Order::with('pizza')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:в ожидании,готовится,в пути,доставлен',
        ]);

        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Статус заказа обновлён!');
    }

    public function destroyOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Заказ удалён.');
    }

    // === ⚙️ Настройки сайта ===
    public function settings()
    {
        $settings = Setting::firstOrCreate([]);
        return view('admin.settings', [
            'admin_email'        => $settings->admin_email,
            'site_name'          => $settings->site_name,
            'notifications'      => $settings->notifications,
            'telegram_bot_token' => $settings->telegram_bot_token,
            'telegram_chat_id'   => $settings->telegram_chat_id,
        ]);
    }

    public function saveSettings(Request $request)
    {
        $settings = Setting::firstOrCreate([]);
        $settings->admin_email        = $request->input('admin_email');
        $settings->site_name          = $request->input('site_name');
        $settings->notifications      = $request->has('notifications') ? 'on' : 'off';
        $settings->telegram_bot_token = $request->input('telegram_bot_token');
        $settings->telegram_chat_id   = $request->input('telegram_chat_id');
        $settings->save();

        return back()->with('success', 'Настройки сохранены!');
    }

    // === 🔔 Уведомления ===
    public function notifications()
    {
        $settings = Setting::firstOrCreate([]);
        return view('admin.notifications', [
            'notifications_enabled' => $settings->notifications === 'on',
            'telegram_bot_token'    => $settings->telegram_bot_token,
            'telegram_chat_id'      => $settings->telegram_chat_id,
        ]);
    }

    public function saveNotifications(Request $request)
    {
        $settings = Setting::firstOrCreate([]);
        $settings->notifications      = $request->has('notifications_enabled') ? 'on' : 'off';
        $settings->telegram_bot_token = $request->input('telegram_bot_token');
        $settings->telegram_chat_id   = $request->input('telegram_chat_id');
        $settings->save();

        return back()->with('success', 'Настройки уведомлений сохранены!');
    }

    // === 🖼 Баннеры ===
    public function banners()
    {
        return view('admin.banners');
    }

    // === 📈 Аналитика ===
public function analytics()
{
    // Основные счётчики
    $orderCount = Order::count();
    $pizzaCount = \App\Models\Pizza::count();
    $userCount  = \App\Models\User::count();

    // Последние заказы
    $recentOrders = Order::with('pizza')->latest()->take(5)->get();

    // Заказы по дням (последние 7 дней)
    $ordersPerDay = [];
    $labels = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $count = Order::whereDate('created_at', $date)->count();
        $labels[] = $date->format('d.m');
        $ordersPerDay[] = $count;
    }

    return view('admin.analytics', compact(
        'orderCount', 'pizzaCount', 'userCount',
        'recentOrders', 'ordersPerDay', 'labels'
    ));
}


}
