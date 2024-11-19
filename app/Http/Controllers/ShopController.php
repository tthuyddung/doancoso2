<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Product;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {

        $user = Auth::user(); // Retrieves the authenticated user
        return view('user.home'); // Trả về view shop.blade.php
    }

    public function add()
    {
        // Lấy user_id từ session
        $user_id = Session::get('user_id', '');

        // Lấy tất cả sản phẩm từ database
        $products = Product::all();

        return view('user.index', compact('products', 'user_id'));
    }
}
