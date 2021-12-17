<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'products';

    public function getAllInCartProducts($cartSession)
    {
        $query = Index::select('*')->whereIn('id', $cartSession)->get()->toArray();
        return $query;
    }
}
