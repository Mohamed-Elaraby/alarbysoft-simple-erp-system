<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginClientController extends Controller
{

    public function index()
    {
        return "Welcome To Client Area";
    }
    public function login()
    {
        return view('auth.client.login');
    }

    public function loginPost(Request $request)
    {
        $remember = $request->has('remember') ? true: false;
        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $remember)){
            return 'welcome ' . Auth::guard('client')->user()->name;
        }else{
            return redirect()->back();
        }
    }
}
