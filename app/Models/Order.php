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

}
