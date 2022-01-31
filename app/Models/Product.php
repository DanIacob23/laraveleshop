<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{   public $guarded = ['id'];
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
