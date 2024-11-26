<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Model đại diện cho sản phẩm/xe
use App\Models\Order;   // Model cho đơn hàng
use Illuminate\Support\Facades\Log;

class RentalController extends Controller
{
    // Trang nhập thông tin thuê xe
    public function rentalInfo($id)
    {
        $product = Product::findOrFail($id);
        return view('user.rental-info', compact('product'));
    }

    // Lưu thông tin thuê và chuyển đến trang xem trước
    public function storeRentalDetails(Request $request, $productId)
{
    // Xác thực và xử lý dữ liệu từ form
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'number' => 'required|string|max:15',
        'email' => 'required|email',
        'method' => 'required|string',
        'destination' => 'required|string|max:255',
        'rental_hours' => 'required|integer|min:1',
        'address' => 'required|string|max:255',
    ]);

    // Kiểm tra người dùng đã đăng nhập chưa
    if (!auth()->check()) {
        return redirect()->route('dangnhap')->with('error', 'You need to log in first.');
    }

    // Lấy thông tin sản phẩm
    $product = Product::findOrFail($productId);

    // Tính tổng tiền
    $totalPrice = $product->price * $validated['rental_hours'];

    // Lưu thông tin đơn hàng vào cơ sở dữ liệu
    $order = Order::create([
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'name' => $validated['name'],
        'number' => $validated['number'],
        'email' => $validated['email'],
        'method' => $validated['method'],
        'destination' => $validated['destination'],
        'address' => $validated['address'],
        'rental_hours' => $validated['rental_hours'],
        'total_price' => $totalPrice,
        'total_products' => $totalPrice, // Tổng tiền
        'payment_status' => 'pending',  // Trạng thái thanh toán ban đầu
    ]);

    // Chuyển hướng tới trang xem trước với thông tin đơn hàng và sản phẩm
    return redirect()->route('xemtruoc', ['productId' => $productId, 'orderId' => $order->id]);
}





    public function showPreview($productId, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $product = Product::findOrFail($productId);

        // Trả về view với thông tin đơn hàng và sản phẩm
        return view('user.checkout', compact('order', 'product'));
    }







    public function placeOrder(Request $request)
{
    $validated = $request->validate([
        'total_price' => 'required|numeric|min:0',
    ]);

    // Get rental info from session
    $rentalInfo = session('rentalInfo', null);
    $productId = session('product_id', null);

    // Check if rentalInfo or productId is null
    if (is_null($rentalInfo) || is_null($productId)) {
        return redirect()->back()->with('error', 'Rental information or product ID is missing.');
    }

    // Create the order
    $order = Order::create([
        'user_id' => auth()->id(), // Add the user_id if not already available
        'product_id' => $productId, // Save the product_id
        'name' => $rentalInfo['name'],
        'number' => $rentalInfo['number'],
        'email' => $rentalInfo['email'],
        'method' => $rentalInfo['method'],
        'destination' => $rentalInfo['destination'],
        'address' => $rentalInfo['address'],
        'rental_hours' => $rentalInfo['rental_hours'],
        'total_price' => $validated['total_price'],
    ]);

    // Clear session data
    session()->forget(['rentalInfo', 'product_id']);

    // Redirect to order success page with success message
    return redirect()->route('orderSuccess')->with('success', 'Your order has been placed successfully.');
}

    

public function showPlacedOrders(Request $request)
{
    // Lấy tất cả đơn hàng của người dùng đã đăng nhập
    $orders = Order::where('user_id', auth()->id())->get();
    
    // Trả về view với thông tin đơn hàng
    return view('user.orders', compact('orders'));
}


    public function calculatePrice(Request $request, $id)
{
    $product = Product::findOrFail($id);

    // Tính tổng tiền dựa trên số giờ thuê
    $rentalHours = $request->input('rental_hours');
    $totalPrice = $product->price * $rentalHours;

    return response()->json([
        'total_price' => $totalPrice
    ]);
}

}
