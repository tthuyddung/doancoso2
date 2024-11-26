<?php

// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
{
    $products = Product::all(); 

    return view('auth.create', compact('products'));
}

    public function create()
    {
        return view('auth.create');
    }

    public function store(Request $request)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'name' => 'required|max:100',
        'price' => 'required|numeric|min:0|max:9999999999',
        'details' => 'required|max:500',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Tạo mới sản phẩm
    $product = new Product();
    $product->name = $request->name;
    $product->price = $request->price;
    $product->details = $request->details;

    // Xử lý upload ảnh
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $product->image = $filename;
    }

    $product->save();

    // Redirect về trang danh sách sản phẩm và hiển thị thông báo thành công
    return redirect()->route('auth.index')->with('success', 'Product added successfully.');
}


    

    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('auth.edit', compact('product'));
}
    

public function destroy(Product $product)
{
    // Xóa sản phẩm và hình ảnh liên quan
    $product->delete();
    Storage::delete('public/images/' . $product->image);

    return redirect()->route('auth.index')->with('success', 'Sản phẩm đã được xóa!');
}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);
    
    // Xác thực dữ liệu
    $request->validate([
        'name' => 'required|max:100',
        'price' => 'required|numeric|min:0|max:9999999999',
        'details' => 'required|max:500',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Kiểm tra ảnh
    ]);

    // Cập nhật thông tin sản phẩm
    $product->name = $request->name;
    $product->price = $request->price;
    $product->details = $request->details;

    // Nếu có ảnh mới được tải lên
    if ($request->hasFile('image')) {
        // Xóa ảnh cũ nếu có
        if ($product->image) {
            // Kiểm tra và xóa ảnh cũ
            $oldImagePath = public_path('images/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa ảnh cũ
            }
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $product->image = $imageName; 
    }

    $product->save();

    return redirect()->route('auth.index')->with('success', 'Product updated successfully.');
}

public function quickView($pid)
    {
      
        $product = Product::find($pid);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        return view('user.quick_view', compact('product'));
    }


}
