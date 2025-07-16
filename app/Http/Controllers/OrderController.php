<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Pizza;

class OrderController extends Controller
{
    public function create()
    {
        $pizzas = Pizza::all();
        return view('orders.create', compact('pizzas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->pizza_id = $request->pizza_id;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->status = 'в ожидании';
        $order->save();

        return redirect()->route('profile')->with('success', 'Заказ успешно создан!');
    }

    public function edit(Order $order)
    {
        $this->authorize('update', $order); // Убедись, что есть политика авторизации

        $pizzas = Pizza::all();
        return view('orders.edit', compact('order', 'pizzas'));
    }

    public function update(Request $request, Order $order)
    {
        $this->authorize('update', $order);

        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
        ]);

        $order->pizza_id = $request->pizza_id;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->save();

        return redirect()->route('profile')->with('success', 'Заказ обновлен!');
    }

    public function destroy(Order $order)
    {
        $this->authorize('delete', $order);

        $order->delete();
        return redirect()->route('profile')->with('success', 'Заказ удален!');
    }
}
