<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $cartSession = $request->session()->get('cartSession', []);
        $productsForIndex =  Product::query()->whereNotIn('id', array_keys($cartSession))->get();
        return view('indexview.index', [
            'productForIndex' => $productsForIndex
        ]);
    }

}
