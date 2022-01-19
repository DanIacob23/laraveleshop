<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function showOrder($orderId)
    {
        $data= Order::with('products')->findOrFail($orderId);
        return view('orderview.order', [
            'orderProducts' => $data
        ]);
    }
}
