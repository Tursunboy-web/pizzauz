<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\Order;
use App\Models\User;
use App\Models\Setting;



class AdminController extends Controller
{
   public function dashboard()
{
    $orders = \App\Models\Order::latest()->take(10)->get();
    return view('admin.dashboard', compact('orders'));
}


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
            'name' => 'required|string',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pizzas', 'public');
        }

        Pizza::create($data);

        return redirect()->route('admin.pizzas')->with('success', 'Пицца добавлена!');
    }

public function editPizza(Pizza $pizza)
{
    return view('admin.edit_pizza', compact('pizza'));
}

public function updatePizza(Request $request, Pizza $pizza)
{
    $data = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|max:2048'
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


    public function orders()
{
    $orderCount = Order::count();

    return view('admin.orders.index', compact('orders'));
}

}
