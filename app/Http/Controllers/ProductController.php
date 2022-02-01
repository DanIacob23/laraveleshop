<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function workWithProduct($id, Request $request)
    {
        if ($request->input('save')) {
            $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]);

            $title = $request->input('title');
            $description = $request->input('description');
            $price = $request->input('price');

            if ($id != 'add') {// edit
                $editId = $id;
                Product::where('id', $editId)->update(['title' => $title, 'description' => $description, 'price' => $price]);
                if ($request->file('fileToUpload')) {
                    $file = $request->file('fileToUpload');
                    $extension = $file->getClientOriginalExtension();
                    $request->file('fileToUpload')->storeAs('public/images', strval($editId) . '.' . $extension);
                    //update extension
                    $product = Product::findOrFail($editId);
                    Product::where('id', $editId)->update(['fileType' => '.'.$extension]);
                }
                return redirect()->route('products');
                //otherwise, it keeps the old image
            } else {//add
                if ($request->file('fileToUpload')) {
                    $file = $request->file('fileToUpload');
                    $extension = $file->getClientOriginalExtension();
                    $product = Product::create([
                        'title' => $title,
                        'description' => $description,
                        'price' => $price,
                        'fileType' => '.' . $extension
                        ]);
                    $request->file('fileToUpload')->storeAs('public/images', strval($product['id']) . '.' . $extension);
                    return redirect()->route('products');
                }
            }

        }
    }

    public function view($id)
    {
        if ($id != 'add') {
            $productAbout = Product::all()->where('id', $id)->toArray();
            return view('productview.product', [
                'productForEdit' => array_values($productAbout)[0]
            ]);
        } else {
            return view('productview.product', [
                'productForEdit' => ['title' => '', 'description' => '', 'price' => '']
            ]);
        }
    }
}
