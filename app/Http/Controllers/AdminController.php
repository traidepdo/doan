<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Đây là trang quản trị của admin
        return view('admin.dashboard');
    }
}
