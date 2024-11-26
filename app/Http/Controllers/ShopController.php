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

        $user = Auth::user();
        return view('user.home');
    }

    public function add()
    {
        $user_id = Session::get('user_id', '');

        $products = Product::all();

        return view('user.index', compact('products', 'user_id'));
    }
}
