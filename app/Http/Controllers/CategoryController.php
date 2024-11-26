<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        
        $products = Product::where('name', 'like', '%' . $category . '%')->get();

        return view('user.category', compact('products', 'category'));
    }
}
