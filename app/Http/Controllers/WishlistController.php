<?php

// app/Http/Controllers/WishlistController.php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{

    public function addToWishlist(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('dangnhap')->with('error', 'You must be logged in to add items to wishlist.');
        }

        $user_id = Auth::id();
        $product_id = $request->input('pid'); // Get the product ID from the request


        $exists = Wishlist::where('user_id', $user_id)
                          ->where('pid', $request->pid)
                          ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This product is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => $user_id,
            'pid' => $request->pid,
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist successfully.');
    }
    // Display wishlist page
    
    public function index()
    {
        $user_id = Auth::id();
        $wishlist_items = Wishlist::where('user_id', $user_id)->get();
        $grand_total = $wishlist_items->sum('price');
        
        return view('user.wishlist', compact('wishlist_items', 'grand_total'));
    }

    // Delete a specific wishlist item
    public function delete($id)
    {
        Wishlist::where('id', $id)->delete();
        return redirect()->route('wishlist.index');
    }

    // Delete all wishlist items
    public function deleteAll()
    {
        $user_id = Auth::id();
        Wishlist::where('user_id', $user_id)->delete();
        return redirect()->route('wishlist.index');
    }

    // Add item to the cart from wishlist (example action)
    public function addToCart(Request $request)
    {
        // Assuming you have a Cart model and logic for adding an item to the cart
        // Example logic here
        return redirect()->route('cart.index');
    }
}
