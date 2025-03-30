<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    // Hiển thị form đăng ký
    public function create()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function store(Request $request)
    {
        // Kiểm tra và xác thực thông tin đầu vào
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Đăng nhập ngay sau khi đăng ký
        auth()->login($user);

        // Chuyển hướng người dùng đến trang sau khi đăng ký thành công
        return redirect(route('user.home'));
    }
}

