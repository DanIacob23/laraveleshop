<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    function deleteFromProductsOrders($idProduct){
        //delete Product From Products
        $productForDelete = Product::find($idProduct);
        $productForDelete->delete();
        //delete Product From Orders
        $productForDelete = Product::find($idProduct);
        if ($productForDelete) {
            $productForDelete->orders()->detach();
        }
    }

    function showAllProductsInfo(Request $request)
    {
        if ($request->input('adminLogout')) {
            $request->session()->pull('adminLogin', true);
            return redirect()->route('index');
        }
        if ($request->input('deleteId')) {
            $deleteId = $request->input('deleteId');
            if (Storage::disk('public')->delete('images/' . $deleteId . '.jpg')) {
                $this->deleteFromProductsOrders($deleteId);
                $request->session()->forget('cartSession.' . $deleteId);//remove from cart
                return redirect()->route('products');
            } else {
                Storage::disk('public')->delete('images/' . $deleteId . '.png');
                $this->deleteFromProductsOrders($deleteId);
                $request->session()->forget('cartSession.' . $deleteId);//remove from cart
                return redirect()->route('products');
            }
        }

    }

    function renderViewProducts(){
        $allProductsInfo = Product::all();
        return view('productsview.products', [
            'allProductsInfo' => $allProductsInfo
        ]);
    }
}
