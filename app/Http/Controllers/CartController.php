<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    function getSession(Request $request)
    {   $request->session()->put('cartSession', []);
        $value = $request->session()->get('cartSession');
        return $value;
    }

    function showInCartProducts(Request $request){
        $cartSession = $request->session()->get('cartSession');
        $inCartProducts =new Cart();
        $productsForCart = $inCartProducts->getAllInCartProducts($cartSession);
        $name = $request->input('name') ? $request->input('name') : '';
        $contactDetails = $request->input('contactDetails') ? $request->input('contactDetails') : '';
        $comments  = $request->input('comments') ? $request->input('comments') : '';
        return view('cartview.cart', [
            'productForCart' => $productsForCart ,
            'name' =>  $name ,
            'contactDetails' => $contactDetails ,
            'comments'=> $comments
        ]);
    }
}


