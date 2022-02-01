<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    function checkLogin(Request $request)
    {
        if ($request->input('submit')) {
            $validated = $request->validate([
                'userName' => 'required|same:password',
                'password' => 'required',
            ]);


            if ($request->input('userName') == config('app.admin_username') && $request->input('password') == config('app.admin_password')) {
                $request->session()->put('adminLogin', true);
                //redirect to products
                return redirect()->route('products');
            }

        }
    }
    function logout(Request $request)
    {
        if ($request->input('adminLogout')) {
            $request->session()->pull('adminLogin', true);
            return redirect()->route('index');
        }
    }
    public function viewLogin(){
        return view('loginview.login');
    }
}
