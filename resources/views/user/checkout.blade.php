@extends('layouts.on')

@section('content')
<div class="containere">
    <!-- Thông tin sản phẩm -->
    <div class="product-details">
        <h3>Thông tin sản phẩm</h3>
        <div class="product">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; border-radius: 10px;">
            <h4>{{ $product->name }}</h4>
            <p>Giá thuê mỗi giờ: <span id="hourly_price">{{ number_format((float)$product->price, 0, ',', '.') }}</span> VNĐ</p>
        </div>
    </div>

    <!-- Thông tin đơn hàng -->
    <div class="order-details">
        <h3>Thông tin đơn hàng</h3>
        <p><strong>Tên:</strong> {{ $order->name ?? 'Order not found' }}</p>
        <p><strong>Số điện thoại:</strong> {{  $order->number ?? 'Order not found' }}</p>
        <p><strong>Email:</strong> {{ $order->email ?? 'Order not found'}}</p>
        <p><strong>Phương thức thanh toán:</strong> {{ $order->method ?? 'Order not found'}}</p>
        <p><strong>Địa điểm đến:</strong> {{ $order->destination ?? 'Order not found'}}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address ?? 'Order not found'}}</p>
        <p><strong>Số giờ thuê:</strong> {{ $order->rental_hours ?? 'Order not found'}}</p>
        <!-- Thay thế giá thuê mỗi giờ bằng tổng tiền -->
        <p><strong>Tổng tiền:</strong> 
            @php
                $totalPrice = $order->rental_hours * $product->price;
            @endphp
            <span id="total_price">{{ number_format((float)$totalPrice, 0, ',', '.') }} VNĐ</span>
        </p>
    </div>

    <!-- Form thanh toán -->
    <form action="{{ route('orderSuccess', ['productId' => $product->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="total_price" value="{{ $order->total_price ?? $totalPrice }}">
        <button type="submit" class="btn">Xác nhận và đặt hàng</button>
    </form>
</div>
@endsection
