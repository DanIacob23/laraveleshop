<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;

class ProductsController extends Controller
{


    function deleteProductFromProducts($id,Request $request){
        if ($request->input('deleteProduct')) {
            $deleteId = $id;
            $extensionProduct = Product::where('id', $deleteId)
                ->get();
            if (Storage::disk('public')->delete('images/' . $deleteId . $extensionProduct[0]['fileType'])) {
                $model = new Order;
                $model->deleteFromProductsOrders($deleteId);
                $request->session()->forget('cartSession.' . $deleteId);//remove from cart
                return redirect()->route('products');
            }
        }
    }


    function index(){
        $allProductsInfo = Product::all();
        return view('productsview.products', [
            'allProductsInfo' => $allProductsInfo
        ]);
    }
}
