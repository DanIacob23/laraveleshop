<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
class OrdersController extends Controller
{
    public function showAllOrders(Request $request)
    {

        $data= Order::with('products')->withCount(['products as total' => function($query) {
            $query->select(Product::raw('SUM(price)'));
        }
        ])->groupBy('id')->get()->toArray();
        return view('ordersview.orders', [
            'ordersProducts' => $data
        ]);
    }
}
