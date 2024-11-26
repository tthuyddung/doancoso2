@extends('layouts.on')

@section('content')
<section class="quick-view">
    <h1 class="heading">Quick View</h1>

    @if($product)
    <div class="box">
        <div class="row">
            <div class="image-container">
                <div class="main-image">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
            </div>
            <div class="content">
                <div class="name">{{ $product->name }}</div>
                <div class="flex">
                    <div class="price"><span>$</span>{{ $product->price }}<span>/-</span> per hour</div>
                    <label for="rental_hours">Number of hours:</label>
                    <input type="number" id="rental_hours" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
                </div>
                <div class="details">{{ $product->details }}</div>
                
                <!-- Total Price Display -->
                <div class="total-price">
                <h3>Tổng tiền:</h3>
                @if(isset($totalPrice))
                    <p>Tổng tiền: {{ number_format($totalPrice, 0, ',', '.') }} VNĐ</p>
                @else
                    <p>Tổng tiền chưa được tính toán.</p>
                @endif

            </div>

                
                <!-- "Book Now" Button -->
                <form action="{{ route('checkout') }}" method="get">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="rental_hours" id="rental_hours_hidden" value="1">
                    <button type="submit" class="btn">Book Now</button>
                </form>
            </div>
        </div>
    </div>
    @else
    <p class="empty">No products added yet!</p>
    @endif
</section>
@endsection
