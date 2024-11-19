<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        // Kiểm tra nếu sản phẩm có trong giỏ hàng
        $cart = session()->get('cart', []);

        $productId = $request->input('pid');
        $quantity = $request->input('qty');
        
        if (isset($cart[$productId])) {
            // Nếu sản phẩm đã có trong giỏ hàng, tăng số lượng
            $cart[$productId]['qty'] += $quantity;
        } else {
            // Nếu sản phẩm chưa có, thêm sản phẩm mới vào giỏ hàng
            $cart[$productId] = [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'image' => $request->input('image'),
                'qty' => $quantity,
            ];
        }

        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }
    // Hiển thị giỏ hàng
    public function index()
    {
        $user_id = Auth::id();
        $cartItems = Cart::where('user_id', $user_id)->get();
        $grand_total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('user.cart', compact('cartItems', 'grand_total'));
    }

    // Xóa một item khỏi giỏ hàng
    public function updateQty(Request $request)
    {
        try {
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $cart = session()->get('cart', []);
            if (isset($cart[$request->cart_id])) {
                $cart[$request->cart_id]['qty'] = $request->qty;
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Số lượng đã được cập nhật!');
            } else {
                return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function delete(Request $request)
    {
        try {
            // Xóa sản phẩm khỏi giỏ hàng
            $cart = session()->get('cart', []);
            if (isset($cart[$request->cart_id])) {
                unset($cart[$request->cart_id]);
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
            } else {
                return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng!');
            }
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra khi xóa sản phẩm!');
        }
    }

    public function deleteAll()
    {
        try {
            // Xóa tất cả sản phẩm khỏi giỏ hàng
            session()->forget('cart');
            return redirect()->route('cart.index')->with('success', 'Tất cả sản phẩm đã được xóa khỏi giỏ hàng!');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Có lỗi xảy ra khi xóa tất cả sản phẩm!');
        }
    }
}
