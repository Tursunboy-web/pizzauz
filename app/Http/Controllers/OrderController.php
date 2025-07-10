<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string'
        ]);

        Order::create($data);

        return redirect()->back()->with('success', 'Заказ успешно отправлен!');
    }
}
