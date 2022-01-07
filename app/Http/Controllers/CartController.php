<?php

namespace App\Http\Controllers;

use App\Mail\CartDetails;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use  Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    static $data = [];
    static $clientName;
    static $contactDetails;
    static $comments;

    function showInCartProducts(Request $request)
    {
        if ($request->session()->exists('cartSession')) {

            if ($request->input('removeToCart')) {
                $request->session()->forget('cartSession.' . $request->input('id'));
                return redirect()->route('cart');
            }
            $cartSession = $request->session()->get('cartSession');

            $inCartProducts = new Cart();

            $productsForCart = $inCartProducts->getAllInCartProducts(array_keys($cartSession));

            self::$data = $productsForCart;
            if ($request->input('checkout')) {
                $validated = $request->validate([
                    'name' => 'required',
                    'contactDetails' => 'required',
                    'comments' => 'required',
                ]);
                if (count($validated) > 0) {
                    self::$clientName = $request->input('name');
                    self::$contactDetails = $request->input('contactDetails');
                    self::$comments = $request->input('comments');
                    $lastIdInOrders = $inCartProducts->insertNewOrder(self::$clientName, self::$contactDetails, self::$comments, date("Y/m/d"), array_keys($cartSession));
                    Mail::to('noreply@example.com')
                        ->send(new CartDetails());
                    $request->session()->flush();
                    return Redirect::to('order?lastOrderId=' . $lastIdInOrders);
                }
            }

            return view('cartview.cart', [
                'productForCart' => $productsForCart,
                'name' => self::$clientName,
                'contactDetails' => self::$contactDetails,
                'comments' => self::$comments
            ]);
        }
    }

    function getData()
    {
        return ['cartProducts' => self::$data, 'clientName' => self::$clientName, 'contactDetails' => self::$contactDetails];
    }
}


