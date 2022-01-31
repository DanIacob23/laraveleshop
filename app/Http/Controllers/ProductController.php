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
                    Product::where('id', $editId)->update(['fileType' => $extension]);
                }
                return redirect()->route('products');
                //otherwise, it keeps the old image
            } else {//add
                if ($request->file('fileToUpload')) {
                    $file = $request->file('fileToUpload');
                    $extension = $file->getClientOriginalExtension();
                    Product::insert([
                        'title' => $title,
                        'description' => $description,
                        'price' => $price,
                        'fileType' => '.' . $extension
                        ]);
                    $lastId = Product::latest('id')->first();
                    $request->file('fileToUpload')->storeAs('public/images', strval($lastId['id']) . '.' . $extension);
                    return redirect()->route('products');
                }
            }

        }
    }

    public function view($id)
    {
        if ($id != 'add') {
            $productAbout = Product::all()->where('id', $id)[$id - 1];
            return view('productview.product', [
                'productForEdit' => $productAbout
            ]);
        } else {
            return view('productview.product', [
                'productForEdit' => ['title' => '', 'description' => '', 'price' => '']
            ]);
        }
    }
}
