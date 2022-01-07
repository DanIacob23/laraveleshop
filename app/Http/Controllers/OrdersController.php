<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Orders;
class OrdersController extends Controller
{
    public function showAllOrders(Request $request){
        if (!$request->session()->exists('adminLogin')) {
            die('Admin logout');
        }
        $orders = new Orders();
        $data = $orders->joinOrders();

        return view('ordersview.orders', [
            'ordersProducts' => $data
        ]);
    }
}
