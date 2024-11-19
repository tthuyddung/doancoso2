<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Hiển thị trang checkout
    public function index()
    {
        $user_id = Auth::id();

        return view('user.checkout', [
            'grand_total' => 0,
            'total_products' => ''
        ]);
    }

    // Xử lý khi đặt hàng
    public function placeOrder(Request $request)
    {
        $user_id = Auth::id();

        // Kiểm tra nếu người dùng đã đăng nhập
        if (!$user_id) {
            return redirect()->route('dangnhap')->with('error', 'Please login first.');
        }

        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:20',
            'number' => 'required|digits_between:10,12',
            'email' => 'required|email|max:50',
            'method' => 'required|string',
            'flat' => 'required|string|max:50',
            'street' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:50',
            'country' => 'required|string|max:50',
            'pin_code' => 'required|digits:6'
        ]);

        // Lưu địa chỉ
        $address = 'Flat No. ' . $request->flat . ', ' . $request->street . ', ' . $request->city . ', ' . $request->state . ', ' . $request->country . ' - ' . $request->pin_code;

        // Tạo đơn hàng mới
        Order::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'number' => $request->number,
            'email' => $request->email,
            'method' => $request->method,
            'address' => $address,
            'total_products' => $request->total_products ?? '',
            'total_price' => $request->total_price ?? 0,
        ]);

        return redirect()->route('checkout')->with('success', 'Order placed successfully!');
    }
}
