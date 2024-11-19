@extends('layouts.app')


@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>   

    </div>
@endif

<section class="add-products">
    <h1 class="heading">Add Product</h1>
    <form action="{{ route('auth.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <div class="flex">
            <div class="inputBox">
                <span>Product Name (required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter product name" name="name">
            </div>
            <div class="inputBox">
                <span>Product Price (required)</span>
                <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
            </div>
            <div class="inputBox">   

                <span>Product Details (required)</span>
                <textarea name="details"   
 class="box" required placeholder="Enter product details" maxlength="500"></textarea>
            </div>
            <div class="inputBox">
                <span>Image 01 (required)</span>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
            </div>   

        </div>
        <input type="submit" value="Add Product" class="btn" name="add_product">
    </form>   


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Recently Added Products</h2>

    @if (isset($products) && count($products) > 0)
    <div class="product-list">
    @foreach ($products as $product)
        <div class="product-item">
            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image">
            <h3>{{ $product->name }}</h3>
            <p>Price: ${{ $product->price }}</p>
            <p>{{ Str::limit($product->details, 100) }}</p>
            <form action="{{ route('auth.destroy', $product->id) }}" method="POST">
  @csrf
  @method('DELETE')  <a href="{{ route('auth.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
  <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
</form>
        </div>   

    @endforeach
</div>

    @else
        <p>No products added yet.</p>
    @endif
</section>

@endsection

<script src="{{ asset('js/admin_script.js') }}"></script>