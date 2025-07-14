<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $orders = Order::with('pizza')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('profile', compact('orders'));
    }
}

