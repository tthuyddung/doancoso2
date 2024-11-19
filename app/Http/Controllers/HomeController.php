<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    // Lấy thông tin người dùng đã đăng nhập
    $user = Auth::user();

    // Lấy 6 sản phẩm mới nhất
    $products = DB::table('products')->limit(6)->get();

    // Truyền cả $user và $products vào view
    return view('user.home', compact('user', 'products'));
}

}
