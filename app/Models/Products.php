<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Products extends Model
{
    protected $table = 'products';

    public function  getAllProductsInfo()
    {
        $query = Products::select('*')->get()->toArray();
        return $query;
    }

    public function deleteProductFromProducts($id){
        $query = Products::where('id',$id)->delete();
        return $query;
    }

    public function deleteProductFromOrders($idProduct){
        $this->table = 'pivot_order';
        $query = Products::where('idProd',$idProduct)->delete();
        return $query;
    }

}
