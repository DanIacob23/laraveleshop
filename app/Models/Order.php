<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    public $guarded = ['id'];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    function deleteFromProductsOrders($idProduct){
        //delete Product From Products
        $productForDelete = Product::find($idProduct);
        $productForDelete->orders()->detach($idProduct);
        $productForDelete->delete();
        //delete Product From Orders
        $productForDelete = Product::find($idProduct);
        if ($productForDelete) {
            $productForDelete->orders()->detach();
        }
    }
}
