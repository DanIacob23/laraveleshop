<?php

namespace App\Http\Controllers;

use App\Mail\CartDetails;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    function showInCartProducts(Request $request)
    {
        if ($request->input('removeToCart')) {
            $request->session()->forget('cartSession.' . $request->input('id'));
            //return redirect()->route('/index');
        }
        $cartSession = $request->session()->get('cartSession');
        $inCartProducts = new Cart();
        $productsForCart = $inCartProducts->getAllInCartProducts($cartSession);
        $name = $request->input('name') ? $request->input('name') : '';
        $contactDetails = $request->input('contactDetails') ? $request->input('contactDetails') : '';
        $comments = $request->input('comments') ? $request->input('comments') : '';

        if ($request->input('checkout')) {
            Mail::to('noreply@example.com')
                ->send(new CartDetails());

            $request->session()->flush();
            //catre order si validare date
        }

        return view('cartview.cart', [
            'productForCart' => $productsForCart,
            'name' => $name,
            'contactDetails' => $contactDetails,
            'comments' => $comments
        ]);
    }
}


