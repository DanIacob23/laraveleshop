<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'products';
    public $timestamps = false;

    public function getAllInCartProducts($cartSession)
    {
        $query = Cart::select('*')->whereIn('id', $cartSession)->get()->toArray();
        return $query;
    }

    public function insertNewOrder($userName, $details, $comments, $date, $cartProductIds)
    {
        $this->table = 'orders';
        Cart::insert([
            ['userName' => $userName, 'contactDetails' => $details, 'comments' => $comments, 'datetime' => $date]
        ]);

        $lastRow = Cart::latest('id')->first();
        $this->table = 'pivot_order';
        foreach ($cartProductIds as $id) {
            Cart::insert([
                ['idProd' => $id, 'idOrder' => $lastRow['id']]
            ]);
        }
        return $lastRow['id'];
    }

}
