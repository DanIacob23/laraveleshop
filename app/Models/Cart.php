<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'products';

    public function getAllInCartProducts($cartSession)
    {
        $query = Cart::select('*')->whereIn('id', array_keys($cartSession))->get()->toArray();
        return $query;
    }

    public function insertNewOrder($userName, $details, $comments,$date,$cartProductIds)
    {
        $this->table = 'orders';
        Cart::insert([
            ['userName' => $userName, 'contactDetails' => $details, 'comments' => $comments,'datetime' => $date]
        ]);

        $this->table = 'pivot_order';
        $lastRow = Product::latest('id')->first();

        foreach($cartProductIds as $id){
            Cart::insert([
                ['idProd' => $id, 'idOrder' => $lastRow]
            ]);
        }

        return $lastRow['id'];
    }

}
