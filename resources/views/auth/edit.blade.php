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
<h1 class="heading">Edit Product</h1>
    <form action="{{ route('auth.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex">
            <div class="inputBox">
                <span>Product Name (required)</span>
                <input type="text" class="box" required maxlength="100" placeholder="Enter product name" name="name" value="{{ old('name', $product->name) }}">
            </div>
            <div class="inputBox">
                <span>Product Price (required)</span>
                <input type="number" min="0" class="box" required max="9999999999" placeholder="Enter product price" onkeypress="if(this.value.length == 10) return false;" name="price" value="{{ old('price', $product->price) }}">
            </div>
            <div class="inputBox">
                <span>Product Details (required)</span>
                <textarea name="details" class="box" required placeholder="Enter product details" maxlength="500">{{ old('details', $product->details) }}</textarea>
            </div>
            <div class="inputBox">
                <span>Image (optional)</span>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
            </div>
        </div>
        <input type="submit" value="Update Product" class="btn" name="update_product">
    </form>
</section>

@endsection
