<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $table = 'products';

    public function getAllProductsNotInCart($cartSession)
    {
        $query = Index::select('*')->whereNotIn('id', $cartSession)->get()->toArray();
        return $query;
    }

}
