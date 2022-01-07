<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $table = 'products';
    function leftJoinProducts($lastOrderId)
    {
        $users = Order::
             leftjoin('pivot_order', 'products.id', '=', 'pivot_order.idProd')
            ->leftjoin('orders', 'orders.id', '=', 'pivot_order.idOrder')
            ->select('products.id', 'products.title', 'products.description', 'products.price', 'products.fileType','orders.userName','orders.contactDetails','orders.comments')
            ->where('pivot_order.idOrder',$lastOrderId)
            ->get()->toArray();
        return $users;
    }
}
