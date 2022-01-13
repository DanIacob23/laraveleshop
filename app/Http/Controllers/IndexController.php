<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function addToCart(Request $request){
        $cartSession = $request->session()->get('cartSession');
        if (!$cartSession) {
            $request->session()->put('cartSession', []);
            $cartSession = $request->session()->get('cartSession');
        }
        if ($request->input('addCart')) {
            $id = $request->input('id');
            if (array_key_exists($id, $cartSession)) {
                //if already exists
                $cartSession[$id] = strval(intval($cartSession[$id]) + 1);
            } else {
                $cartSession[$id] = 1;
            }

            $request->session()->put('cartSession', $cartSession);
            return redirect()->route('index');
        }
    }
    public function showNotInCart(Request $request)
    {

        $cartSession = $request->session()->get('cartSession');
        if (!$cartSession) {
            $request->session()->put('cartSession', []);
            $cartSession = $request->session()->get('cartSession');
        }
        $productsForIndex =  Product::query()->whereNotIn('id', array_keys($cartSession))->get();
        return view('indexview.index', [
            'productForIndex' => $productsForIndex
        ]);

    }

}
