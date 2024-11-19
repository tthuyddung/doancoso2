<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pid', 'name', 'image', 'price', 'quantity'];

    public function index()
{
    $user_id = Auth::id(); // Lấy user_id từ session nếu đã đăng nhập
    $cart_count = $user_id ? Cart::where('user_id', $user_id)->count() : 0;
    
    return view('cart.index', compact('cart_count'));
}
}
