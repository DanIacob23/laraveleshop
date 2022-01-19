<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function workWithProduct(Request $request)
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

            if (request('editId')) {// edit
                $editId = request('editId');
                Product::where('id', $editId)->update(['title' => $title, 'description' => $description, 'price' => $price]);
                if ($request->file('fileToUpload')) {
                    $file = $request->file('fileToUpload');
                    $extension = $file->getClientOriginalExtension();
                    $request->file('fileToUpload')->storeAs('public/images', strval($editId) . '.' . $extension);
                    //update extension
                    Product::where('id', $editId)->update(['fileType' => $extension]);
                }
                return redirect()->route('products');
                //otherwise, it keeps the old image
            } else {//add
                if ($request->file('fileToUpload')) {
                    $file = $request->file('fileToUpload');
                    $extension = $file->getClientOriginalExtension();
                    Product::insert([
                        ['title' => $title, 'description' => $description, 'price' => $price, 'fileType' => '.' . $extension]
                    ]);
                    $lastId = Product::latest('id')->first();
                    $request->file('fileToUpload')->storeAs('public/images', strval($lastId['id']) . '.' . $extension);
                    return redirect()->route('products');
                }
            }

        }
    }

    public function renderProductView()
    {
        if (request('editId')) {
            $productAbout = Product::all()->where('id', request('editId'))[request('editId') - 1];
        }
        if (request('editId')) {
            return view('producteditview.productedit', [
                'productForEdit' => $productAbout
            ]);
        } else {
            return view('productaddview.productadd');
        }
    }
}
