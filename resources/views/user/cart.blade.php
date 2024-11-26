@extends('layouts.on')

@section('content')
<div class="shopping-cart">
    <h3 class="heading">Shopping Cart</h3>

    <div class="box-container">
        @if($cartItems->isEmpty())
            <p class="empty">Your cart is empty</p>
        @else
            @foreach($cartItems as $item)
                <form action="{{ route('cart.update.qty') }}" method="POST" class="box">
                    @csrf
                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                    <a href="{{ route('product.quick_view', $item->pid) }}" class="fas fa-eye"></a>
                    <img src="{{ asset('images/' . $item->image) }}" alt="">
                    <div class="name">{{ $item->name }}</div>
                    <div class="flex">
                        <div class="price">${{ $item->price }}/-</div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="{{ $item->quantity }}">
                        <button type="submit" class="fas fa-edit"></button>
                    </div>
                    <div class="sub-total">Sub total: <span>${{ $item->price * $item->quantity }}/-</span></div>
                    <button type="submit" class="delete-btn" onclick="return confirm('Delete this from cart?');" name="delete">Delete Item</button>
                </form>
            @endforeach
        @endif
    </div>

    <div class="cart-total">
        <p>Grand Total: <span>${{ $grandTotal }}</span></p>
        <form action="{{ route('cart.clear') }}" method="POST" style="display: inline-block;">
    @csrf
    <button type="submit" class="delete-btn {{ $grandTotal > 0 ? '' : 'disabled' }}" onclick="return confirm('Delete all from cart?');">Delete All Items</button>
</form>

        <a href="{{ route('checkout') }}" class="btn {{ $grandTotal > 0 ? '' : 'disabled' }}">Proceed to Checkout</a>
    </div>
</div>
@endsection
