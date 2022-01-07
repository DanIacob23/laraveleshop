<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    function checkLogin(Request $request)
    {

        if ($request->input('uname') == config('app.ADMIN_USERNAME') && $request->input('pass') == config('app.ADMIN_PASSWORD')) {
            $request->session()->put('adminLogin', true);
            //redirect to products
            return redirect()->route('products');
        }
        return view('loginview.login');
    }

}
