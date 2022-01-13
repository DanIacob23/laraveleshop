<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;

class LoginController extends Controller
{
    function checkLogin(Request $request)
    {
        $loginErr = ['loginerr' => ''];
        if ($request->input('submit')) {
            $validated = $request->validate([
                'userName' => 'required',
                'password' => 'required',
            ]);

            if (count($validated) > 0) {
                if ($request->input('userName') == config('app.admin_username') && $request->input('password') == config('app.admin_password')) {
                    $request->session()->put('adminLogin', true);
                    //redirect to products
                    return redirect()->route('products');
                } else {
                    if ($request->input('userName') && $request->input('password')) {
                        $loginErr['loginerr'] = __('eng.loginerr');

                        return view('loginview.login', [
                            'loginerr' => $loginErr['loginerr'],
                        ]);
                    }

                }
            }
        }
    }

    public function viewLogin(){
        return view('loginview.login', [
            'loginerr' => '',
        ]);
    }
}
