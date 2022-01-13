<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function showOrder()
    {
        if (request('lastOrderId')) {
            $lastOrderId = request('lastOrderId');
            $data= Order::with('products')->findOrFail($lastOrderId);
            if (empty($data)) {
                die('No products in cart');
            }
            return view('orderview.order', [
                'orderProducts' => $data
            ]);
        }

    }
}
