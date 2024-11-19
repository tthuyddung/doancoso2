<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_box = $request->input('search_box');

        // Tìm kiếm sản phẩm theo tên
        $products = [];
        if ($search_box) {
            $products = Product::where('name', 'LIKE', '%' . $search_box . '%')->get();
        }

        return view('user.search', compact('products', 'search_box'));
    }
}
