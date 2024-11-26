<?php

// CheckoutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index($productId)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu
        $product = Product::findOrFail($productId);

        // Truyền sản phẩm vào view
        return view('user.checkout', compact('product'));
    }

    public function storeRentalDetails(Request $request, $product_id)
    {
        // Lưu thông tin vào session
        session([
            'rental_details' => $request->all(),
        ]);

        // Chuyển hướng đến trang checkout với product_id
        return redirect()->route('checkout', $product_id);
    }

    public function processPayment(Request $request)
    {
        // Kiểm tra nếu thông tin thanh toán hợp lệ
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'total_price' => 'required|numeric',
        ]);

        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $product = Product::find($request->product_id);

        // Tạo đơn hàng trong cơ sở dữ liệu
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => session('rental_details.name'),
            'number' => session('rental_details.number'),
            'email' => session('rental_details.email'),
            'method' => session('rental_details.method'),
            'address' => session('rental_details.address'),
            'destination' => session('rental_details.destination'),
            'rental_hours' => session('rental_details.rental_hours'),
            'total_products' => $product->name,
            'total_price' => $request->total_price,
        ]);

        // Giả sử thanh toán thành công:
        return redirect()->route('thankyou');
    }
}
