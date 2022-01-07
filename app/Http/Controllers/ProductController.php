<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function updateImage($idd, $target_file, $oldPath)
    {
        $product = new Product();
        $checkImg = '';
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;
        $extension = '.' . pathinfo(basename($target_file), PATHINFO_EXTENSION);

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
        if ($check !== false) {
            $checkImg = 'File is img' . $check['mime'];
            $uploadOk = 1;
        } else {
            $checkImg = 'File is not img';
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            //remove old image
            unlink($oldPath);
        }

        // Check file size
        if ($_FILES['fileToUpload']['size'] > 5000000) {
            $checkImg ='File too large';
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            $checkImg = 'only jpg png';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $checkImg = 'not uploaded';
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                $checkImg = htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . 'uploaded';
                //update new extension
                $product->updateProductExtension($idd, $extension);
            } else {
                $checkImg = 'error uploading';
            }
        }
        return $checkImg;
    }

    function insertNewImage($lastId)
    {
        $checkImg = '';
        $target_dir = "../public/images/";
        $target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_file = $target_dir . strval($lastId) . '.' . $imageFileType;
        $uploadOk = 1;

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
        if ($check !== false) {
            $checkImg = 'File is img' . $check['mime'];
            $uploadOk = 1;
        } else {
            $checkImg = 'File is not img';
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['fileToUpload']['size'] > 5000000) {
            $checkImg = 'File too large';
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
            $checkImg = 'only jpg png';
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $checkImg = 'not uploaded';
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
                $checkImg = htmlspecialchars(basename($_FILES['fileToUpload']['name'])) . 'uploaded';
            } else {
                $checkImg = 'error uploading';
            }
        }
        return $checkImg;
    }

    public function workWithProduct(Request $request)
    {
        if (!$request->session()->exists('adminLogin')) {
            die('Admin logout');
        }
        $product = new Product();
        $productAbout = $product->selectProductByID(request('editId'));

        if ($request->input('save')) {
            $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]);
            if (count($validated) > 0) {
                $title = $request->input('title');
                $description = $request->input('description');
                $price = $request->input('price');
                if (request('editId')) {// edit
                    $editId = request('editId');
                    $product->productUpdate($editId, $title, $description, $price);
                    if ($_FILES['fileToUpload']['name'] != '') {
                        $oldPath = '../public/images/' . $editId . $productAbout[0]['fileType'];// remove old image
                        $extension = '.' . pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);//new extension
                        $checkImg = $this->updateImage($editId, '../public/images/' . $editId . $extension, $oldPath);//keep old name and update image
                    }
                    return redirect()->route('products');
                    //otherwise, it keeps the old image
                } else {
                    if ($_FILES['fileToUpload']['name'] != '') {
                        // insert new product USING user data
                        $extension = '.' . pathinfo(basename($_FILES['fileToUpload']['name']), PATHINFO_EXTENSION);
                        $lastId = $product->productInsert(htmlspecialchars($title), htmlspecialchars($description), htmlspecialchars($price), $extension);
                        $checkImg = $this->insertNewImage($lastId);
                        return redirect()->route('products');
                    } else {
                        $errors['image'] = 'not img upload';
                    }
                }
            }
        }
        if (request('editId')) {
             $request->input('title', 'Sally');
             $request->input('description', 'Sally');
             $request->input('price', 'Sally');
            return view('producteditview.productedit', [
                'productForEdit' => $productAbout
            ]);
        } else {
            return view('productaddview.productadd');
        }

    }
}
