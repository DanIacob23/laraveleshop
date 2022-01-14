<?php

namespace App\Http\Controllers;

use App\Mail\CartDetails;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use  Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    function checkoutOrDelete(Request $request){
        if ($request->session()->exists('cartSession')) {
            if ($request->input('removeToCart')) {
                $request->session()->forget('cartSession.' . $request->input('id'));
                return redirect()->route('cart');
            }

            $cartSession = $request->session()->get('cartSession');
            $productsForCart = Product::query()->whereIn('id', array_keys($cartSession))->get();
            $data = $productsForCart;

            $clientName = $request->input('name');
            $contactDetails = $request->input('contactDetails');
            $comments = $request->input('comments');

            if ($request->input('checkout')) {
                $validated = $request->validate([
                    'name' => 'required',
                    'contactDetails' => 'required',
                    'comments' => 'required',
                ]);
                if (count($validated) > 0) {
                    Order::insert([
                        ['userName' => $clientName, 'contactDetails' => $contactDetails, 'comments' => $comments, 'datetime' => date("Y/m/d")]
                    ]);

                    $lastRowId = Order::latest('id')->first()['id'];
                    foreach (array_keys($cartSession) as $id) {
                        $user = Product::find($id);
                        $user->orders()->attach($lastRowId);
                    }

                    Mail::to('noreply@example.com')
                        ->send(new CartDetails($data, $clientName, $contactDetails));
                    $request->session()->forget('cartSession');
                    return Redirect::to('order?lastOrderId=' . $lastRowId);
                }
            }
        }
    }

    function showInCartProducts(Request $request)
    {

        if ($request->session()->exists('cartSession')) {

            $cartSession = $request->session()->get('cartSession');
            $productsForCart = Product::query()->whereIn('id', array_keys($cartSession))->get();

            $clientName = $request->input('name');
            $contactDetails = $request->input('contactDetails');
            $comments = $request->input('comments');

            return view('cartview.cart', [
                'productForCart' => $productsForCart,
                'name' => $clientName,
                'contactDetails' => $contactDetails,
                'comments' => $comments
            ]);
        }
    }


}


