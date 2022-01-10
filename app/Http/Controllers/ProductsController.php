<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    function showAllProductsInfo(Request $request)
    {
        if (!$request->session()->exists('adminLogin')) {
            die('Admin logout');
        }
        $prod = new Products();
        if ($request->input('adminLogout')) {
            $request->session()->pull('adminLogin', true);
            return redirect()->route('index');
        }
        if ($request->input('deleteId')) {
            $deleteId = $request->input('deleteId');
            if (unlink('../storage/app/public/images/' . $deleteId . '.jpg')) {
                $prod->deleteProductFromProducts($deleteId);
                $prod->deleteProductFromOrders($deleteId);
                $request->session()->forget('cartSession.' . $deleteId);//remove from cart
                return redirect()->route('products');
            } else {
                unlink('../storage/app/public/images/' . $deleteId . '.png');
                $prod->deleteProductFromProducts($deleteId);
                $prod->deleteProductFromOrders($deleteId);
                $request->session()->forget('cartSession.' . $deleteId);//remove from cart
                return redirect()->route('products');
            }
        }

        $allProductsInfo = $prod->getAllProductsInfo();
        return view('productsview.products', [
            'allProductsInfo' => $allProductsInfo
        ]);
    }
}
