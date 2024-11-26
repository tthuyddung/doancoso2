<?php

namespace App\Http\Controllers;

use App\Models\Order; 
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all(); // Fetch all orders
        return view('auth.placed_orders', compact('orders'));
    }

    public function updatePayment(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'payment_status' => 'required|string',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->payment_status = $request->payment_status;
        $order->save();

        return redirect()->route('placed.orders')->with('message', 'Payment status updated!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('placed.orders')->with('message', 'Order deleted successfully!');
    }

    public function edit($id)
{
    $order = Order::findOrFail($id); // Fetch the order by ID
    return view('auth.update_order', compact('order')); // Pass the order data to the view
}

public function update(Request $request)
{
    $request->validate([
        'order_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'number' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'total_products' => 'required|integer',
        'total_price' => 'required|numeric',
        'payment_status' => 'required|string',
    ]);

    $order = Order::findOrFail($request->order_id);
    $order->name = $request->name;
    $order->number = $request->number;
    $order->address = $request->address;
    $order->total_products = $request->total_products;
    $order->total_price = $request->total_price;
    $order->payment_status = $request->payment_status;
    $order->save();

    return redirect()->route('placed.orders')->with('message', 'Order updated successfully!');
}

public function placeOrder(Request $request)
{
    $validated = $request->validate([
        'total_price' => 'required|numeric|min:0',
    ]);

    // Lấy thông tin thuê xe từ session
    $rentalInfo = session('rentalInfo', null);
    $productId = session('product_id', null);

    // Kiểm tra xem rentalInfo hoặc productId có bị thiếu không
    if (is_null($rentalInfo) || is_null($productId)) {
        return redirect()->back()->with('error', 'Thông tin thuê xe hoặc ID sản phẩm bị thiếu.');
    }

    // Tạo đơn hàng mới
    $order = Order::create([
        'user_id' => auth()->id(),
        'product_id' => $productId,
        'name' => $rentalInfo['name'],
        'number' => $rentalInfo['number'],
        'email' => $rentalInfo['email'],
        'method' => $rentalInfo['method'],
        'destination' => $rentalInfo['destination'],
        'address' => $rentalInfo['address'],
        'rental_hours' => $rentalInfo['rental_hours'],
        'total_price' => $validated['total_price'],
    ]);

    // Xóa dữ liệu session
    session()->forget(['rentalInfo', 'product_id']);

    return redirect()->route('orderSuccess', ['orderId' => $order->id]);

}

}
