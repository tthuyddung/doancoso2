@extends('layouts.on')

@section('content')

<section class="products">
   <h1 class="heading">Latest Products</h1>

   <div class="box-container">
      @if($products->count() > 0)
         @foreach($products as $product)
         <form>
            @csrf
            <input type="hidden" name="pid" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <input type="hidden" name="image" value="{{ $product->image }}">

            <!-- Icon Xem nhanh -->
            <a href="{{ url('quick_view', $product->id) }}" class="fas fa-eye"></a>

            <!-- Ảnh sản phẩm -->
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">

            <!-- Tên sản phẩm -->
            <div class="name">{{ $product->name }}</div>

            <!-- Phần giá và số lượng -->
            <div class="flex">
               <div class="price"><span>$</span>{{ $product->price }}<span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>

            <!-- Nút thêm vào giỏ hàng -->
            <input type="submit" value="Add to Cart" class="btn">
         </form>
         @endforeach
      @else
         <p class="empty">No products found!</p>
      @endif
   </div>
</section>

@endsection
