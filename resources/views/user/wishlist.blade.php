<!-- resources/views/wishlist/index.blade.php -->

@extends('layouts.on')

@section('content')
<section class="products">
   <h3 class="heading">your wishlist</h3>

   <div class="box-container">
      @forelse ($wishlist_items as $item)
         <form action="{{ route('wishlist.addToCart') }}" method="post" class="box">
            @csrf
            <input type="hidden" name="pid" value="{{ $item->pid }}">
            <input type="hidden" name="wishlist_id" value="{{ $item->id }}">
            <input type="hidden" name="name" value="{{ $item->name }}">
            <input type="hidden" name="price" value="{{ $item->price }}">
            <input type="hidden" name="image" value="{{ $item->image }}">
            <a href="{{ route('product.quick_view', $item->pid) }}" class="fas fa-eye"></a>
            <img src="{{ asset('images/' . $item->image) }}" alt="">
            <div class="name">{{ $item->name }}</div>
            <div class="flex">
               <div class="price">$ {{ $item->price }}</div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="1">
            </div>
            <button type="submit" class="btn">add to cart</button>
            <a href="{{ route('wishlist.delete', $item->id) }}" class="delete-btn" onclick="return confirm('delete this from wishlist?');">delete item</a>
         </form>
      @empty
         <p class="empty">your wishlist is empty</p>
      @endforelse
   </div>

   <div class="wishlist-total">
      <p>grand total : <span>${{ $grand_total }}</span></p>
      <a href="{{ route('shop') }}" class="option-btn">continue shopping</a>
      <a href="{{ route('shop') }}" class="delete-btn {{ $grand_total > 1 ? '' : 'disabled' }}" onclick="return confirm('delete all from wishlist?');">delete all item</a>
   </div>
</section>
@endsection
