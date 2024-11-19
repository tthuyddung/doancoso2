@extends('layouts.app')

@section('content')
<section class="update-order">

    <h1 class="heading">Update Order</h1>

    @if(session('message'))
        <p class="message">{{ session('message') }}</p>
    @endif

    <form action="{{ route('order.update') }}" method="post">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ $order->name }}" required>

        <label for="number">Number:</label>
        <input type="text" name="number" id="number" value="{{ $order->number }}" required>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="{{ $order->address }}" required>

        <label for="total_products">Total Products:</label>
        <input type="number" name="total_products" id="total_products" value="{{ $order->total_products }}" required>

        <label for="total_price">Total Price:</label>
        <input type="number" name="total_price" id="total_price" value="{{ $order->total_price }}" required step="0.01">

        <label for="payment_status">Payment Status:</label>
        <select name="payment_status" id="payment_status" required>
            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Completed</option>
        </select>

        <input type="submit" value="Update Order" class="option-btn">
    </form>

</section>
@endsection
