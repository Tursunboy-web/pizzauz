<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PizzaController extends Controller
{
  public function index(Request $request)
{
    $query = Pizza::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('min')) {
        $query->where('price', '>=', $request->min);
    }

    if ($request->filled('max')) {
        $query->where('price', '<=', $request->max);
    }

    $pizzas = $query->latest()->get();

    return view('home', compact('pizzas'));
}

    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);
        return view('pizzas.show', compact('pizza'));
    }
}
