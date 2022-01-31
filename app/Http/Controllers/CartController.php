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

    function deleteProduct($id,Request $request){
        if ($request->input('removeToCart')) {
            $request->session()->forget('cartSession.' . $id);
            return redirect()->route('cart');
        }
    }

    function checkout(Request $request){
        if ($request->session()->exists('cartSession')) {
            if ($request->input('checkout')) {
                $cartSession = $request->session()->get('cartSession', []);
                $data = Product::query()->whereIn('id', array_keys($cartSession))->get();

                $clientName = $request->input('name');
                $contactDetails = $request->input('contactDetails');
                $comments = $request->input('comments');
                $validated = $request->validate([
                    'name' => 'required',
                    'contactDetails' => 'required',
                    'comments' => 'required',
                ]);

                $order = Order::create([
                    'userName' => $clientName,
                    'contactDetails' => $contactDetails,
                    'comments' => $comments,
                    'datetime' => date("Y/m/d")
                ]);

                $order->products()->sync(array_keys($cartSession));

                Mail::to(config('app.admin_email'))
                    ->send(new CartDetails($data, $clientName, $contactDetails));
                $request->session()->forget('cartSession');
                return redirect()->route('order', [ 'orderId' => $order->id]);
            }
        }
    }

    function index(Request $request)
    {
        if ($request->session()->exists('cartSession')) {

            $cartSession = $request->session()->get('cartSession', []);
            $productsForCart = Product::query()->whereIn('id', array_keys($cartSession))->get();


            return view('cartview.cart', [
                'productForCart' => $productsForCart
            ]);
        }
        return redirect()->route('index');
    }


}


