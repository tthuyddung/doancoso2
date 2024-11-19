<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Message;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        // Middleware to check if admin is logged in
        $this->middleware(function ($request, $next) {
            if (!Session::has('admin_id')) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $users = User::all();
        return view('auth.users_accounts', compact('users'));
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        Order::where('user_id', $id)->delete();
        // Message::where('user_id', $id)->delete();
        // Cart::where('user_id', $id)->delete();
        // Wishlist::where('user_id', $id)->delete();

        return redirect()->route('users.accounts')->with('success', 'User and related data deleted');
    }
}
