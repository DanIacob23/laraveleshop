<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Index;

class IndexController extends Controller
{
    public function showNotInCart(Request $request)
    {
        $cartSession = $request->session()->get('cartSession');
        if (empty($cartSession)) {
            $request->session()->put('cartSession', []);
        }
        if ($request->input('addCart')) {
            $id = $request->input('id');
            $cartSession = $request->session()->get('cartSession');
            if (array_key_exists($id, $cartSession)) {
                //if already exists
                $cartSession[$id] = strval(intval($cartSession[$id]) + 1);
            } else {
                $cartSession[$id] = 1;
            }

            $request->session()->put('cartSession', $cartSession);
            return redirect()->route('index');
        }

        $cartSession = $request->session()->get('cartSession');
        $pre_expedition = new Index();
        $productsForIndex = $pre_expedition->getAllProductsNotInCart($cartSession);
        return view('indexview.index', [
            'productForIndex' => $productsForIndex
        ]);
    }

}
