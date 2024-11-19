<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminRegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register_admin'); // Chỉ định view cho trang đăng ký
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:admins,name', // Kiểm tra tên người dùng
            'pass' => 'required|string|max:20',
            'cpass' => 'required|string|max:20|same:pass', // Kiểm tra mật khẩu xác nhận
        ]);

        // Lưu admin mới vào cơ sở dữ liệu
        DB::table('admins')->insert([
            'name' => $request->name,
            'password' => Hash::make($request->pass), // Mã hóa mật khẩu
        ]);

        return redirect()->route('auth.register_admin')->with('success', 'New admin registered successfully!');
    }
}
