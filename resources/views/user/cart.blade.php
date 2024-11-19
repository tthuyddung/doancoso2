@extends('layouts.on')

@section('content')
<section class="products shopping-cart">
   <h3 class="heading">Shopping Cart</h3>

   @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


   <div class="box-container">
      @php $grand_total = 0; @endphp
      @forelse ($cartItems as $item)
         <form action="{{ route('cart.updateQty') }}" method="post" class="box">
            @csrf
            <input type="hidden" name="cart_id" value="{{ $item->id }}">
            <a href="{{ url('quick_view', $item->pid) }}" class="fas fa-eye"></a>
            <img src="{{ asset('uploaded_img/' . $item->image) }}" alt="">
            <div class="name">{{ $item->name }}</div>
            <div class="flex">
               <div class="price">${{ $item->price }}</div>
               <input type="number" name="qty" class="qty" min="1" max="99" value="{{ $item->quantity }}">
               <button type="submit" class="fas fa-edit"></button>
            </div>
            <div class="sub-total"> Sub total: <span>${{ $item->price * $item->quantity }}</span> </div>
         </form>
         <form action="{{ route('cart.delete') }}" method="post">
            @csrf
            <input type="hidden" name="cart_id" value="{{ $item->id }}">
            <button type="submit" onclick="return confirm('Delete this from cart?')" class="delete-btn">Delete Item</button>
         </form>
         @php $grand_total += $item->price * $item->quantity; @endphp
      @empty
         <p class="empty">Your cart is empty</p>
      @endforelse
   </div>

   <div class="cart-total">
      <p>Grand Total: <span>${{ $grand_total }}</span></p>
      <a href="{{ url('shop') }}" class="option-btn">Continue Shopping</a>
      <a href="{{ route('cart.deleteAll') }}" class="delete-btn" onclick="return confirm('Delete all from cart?')">Delete All Items</a>
      <a href="{{ url('checkout') }}" class="btn {{ $grand_total > 0 ? '' : 'disabled' }}">Proceed to Checkout</a>
   </div>
</section>
@endsection
