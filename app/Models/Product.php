<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    public function selectProductByID($id)
    {
        $query = Product::select('*')->where('id', '=', $id)->get()->toArray();;
        return $query;
    }

    function productUpdate($id, $title, $description, $price)
    {
        $affected = Product::where('id', $id)->update(['title' => $title, 'description' => $description, 'price' => $price]);
    }

    function updateProductExtension($id, $ext)
    {
        $affected = Product::where('id', $id)->update(['fileType' => $ext]);
    }

    function productInsert($title, $description, $price, $extension)
    {
        Product::insert([
            ['title' => $title, 'description' => $description, 'price' => $price,'fileType' =>  $extension]
        ]);
        $lastRow = Product::latest('id')->first();
        return $lastRow['id'];
    }
}
