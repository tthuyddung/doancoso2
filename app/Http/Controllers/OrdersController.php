<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrdersController extends Controller
{
    // Hàm hiển thị danh sách đơn hàng
    public function index()
    {
        $user_id = Auth::id();

        // Kiểm tra nếu người dùng chưa đăng nhập
        if (!$user_id) {
            return redirect()->route('dangnhap')->with('error', 'Please login to see your orders');
        }

        // Lấy danh sách đơn hàng của người dùng
        $orders = Order::where('user_id', $user_id)->get();

        return view('user.orders', compact('orders'));
    }
}
