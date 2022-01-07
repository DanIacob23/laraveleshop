<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    public function showOrder(){
        $order = new Order();
        if (request('lastOrderId')) {
            $lastOrderId = request('lastOrderId');
            $data = $order->leftJoinProducts($lastOrderId);
            if (empty($data)) {
                die('No products in cart');
            }
            return view('orderview.order', [
                'orderProducts' => $data
            ]);
        }

    }
}
