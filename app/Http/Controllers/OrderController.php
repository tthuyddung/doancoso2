<?php

namespace App\Http\Controllers;

use App\Models\Order; // Make sure to import the Order model
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

}
