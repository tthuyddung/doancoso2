<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
{
    // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
    $product = Product::find($id);

    if ($product) {
        $user_id = Auth::id();
        if (!$user_id) {
            return redirect()->route('login');
        }

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $existingCartItem = Cart::where('user_id', $user_id)
            ->where('pid', $product->id)
            ->first();

        if ($existingCartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
            $existingCartItem->quantity += $request->qty;
            $existingCartItem->save();
        } else {
            // Nếu chưa có, thêm sản phẩm mới vào giỏ hàng
            Cart::create([
                'user_id' => $user_id,
                'pid' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->qty,
                'image' => $product->image,
            ]);
        }

        return redirect()->route('cart.index'); // Sau khi thêm vào giỏ hàng, chuyển hướng đến trang giỏ hàng
    }

    return back()->with('error', 'Product not found.');
}

    


    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $grandTotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'grandTotal'));
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer',
            'qty' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        $cartItem->update([
            'quantity' => $request->qty,
        ]);

        return back()->with('message', 'Cart quantity updated');
    }

    public function deleteItem(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer',
        ]);

        $cartItem = Cart::findOrFail($request->cart_id);
        $cartItem->delete();

        return back()->with('message', 'Item removed from cart');
    }

    public function clearCart()
{
    // Lấy thông tin người dùng đã đăng nhập
    $user = Auth::user();

    // Xóa tất cả sản phẩm trong giỏ hàng của người dùng từ cơ sở dữ liệu
    Cart::where('user_id', $user->id)->delete();

    // Chuyển hướng về trang giỏ hàng với thông báo
    return redirect()->route('cart.index')->with('message', 'All items have been removed from the cart');
}




}
