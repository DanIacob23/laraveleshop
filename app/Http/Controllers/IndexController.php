<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Index;

class IndexController extends Controller
{
    public function setCartSession(Request $request)
    {
        $cartSession = $request->session()->get('cartSession');
        if (empty($cartSession)) {
            $request->session()->put('cartSession', []);
        }
    }

    public function showNotInCart(Request $request)
    {
        if ($request->input('addCart')) {
            $request->session()->push('cartSession', $request->input('id'));
            //return redirect()->route('/index');
        }
        $cartSession = $request->session()->get('cartSession');
        $pre_expedition = new Index();
        $productsForIndex = $pre_expedition->getAllProductsNotInCart($cartSession);
        return view('indexview.index', [
            'productForIndex' => $productsForIndex
        ]);
    }

}
