<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginValidation;

/**
 * @ This is loginController class v1.0
 */

class LoginController extends Controller
{


    public function login()
    {

        return view('dashboard.auth.login');
    }

    public function PostLogin(AdminLoginValidation $request)
    {
        $remember_me = $request->has('remember_me')?true : false;

         if(auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me))
         {
             return redirect()->route('dashboard');
         }
         
         return redirect()->back()->with(['error' => 'هناك  خطأ في البيانات']);

    }

 
}
