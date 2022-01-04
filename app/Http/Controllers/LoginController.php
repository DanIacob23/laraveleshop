<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    function checkLogin(Request $request)
    {

        if ($request->input('uname') == 'admin' && $request->input('pass') == 'admin') {
            $request->session()->put('adminLogin', true);
            //redirect to products
            return redirect()->route('login');
        }
        return view('loginview.login');
    }

}
