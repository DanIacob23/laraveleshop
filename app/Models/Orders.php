<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Orders extends Model
{
    protected $table = 'products';
    public function joinOrders()
    {
        $users = Orders::
        leftjoin('pivot_order', 'products.id', '=', 'pivot_order.idProd')
            ->leftjoin('orders', 'orders.id', '=', 'pivot_order.idOrder')
            ->select(array(
                'orders.*',
                Orders::raw('SUM(products.price) as total')
            ))
            ->groupBy('orders.id')
            ->get()->toArray();
        return $users;
    }
}
