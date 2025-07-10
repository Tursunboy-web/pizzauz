<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
{
    $pizzas = Pizza::latest()->get();
    return view('home', compact('pizzas'));
}

    public function show($id)
    {
        $pizza = Pizza::findOrFail($id);
        return view('pizzas.show', compact('pizza'));
    }
}
