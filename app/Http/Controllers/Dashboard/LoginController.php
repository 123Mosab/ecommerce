<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class LoginController extends Controller
{
    public function login(){

        return view('dashboard.auth.login');
    }

 
}
