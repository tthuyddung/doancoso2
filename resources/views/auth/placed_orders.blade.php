@extends('layouts.app') <!-- Extend your admin layout -->

@section('content')
<section class="orders">

    <h1 class="heading">Placed Orders</h1>

    @if(session('message'))
        <p class="message">{{ session('message') }}</p>
    @endif

    <div class="box-container">

        @if($orders->count())
            @foreach($orders as $order)
                <div class="box">
                    <p>Placed on: <span>{{ $order->placed_on }}</span></p>
                    <p>Name: <span>{{ $order->name }}</span></p>
                    <p>Number: <span>{{ $order->number }}</span></p>
                    <p>Address: <span>{{ $order->address }}</span></p>
                    <p>Total products: <span>{{ $order->total_products }}</span></p>
                    <p>Total price: <span>${{ $order->total_price }}</span></p>
                    <p>Payment method: <span>{{ $order->method }}</span></p>

                    <form action="{{ route('update.payment') }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <select name="payment_status" class="select">
                            <option selected disabled>{{ $order->payment_status }}</option>
                            <option value="pending">pending</option>
                            <option value="completed">completed</option>
                        </select>
                        <div class="flex-btn">
                        <a href="{{ route('order.edit', $order->id) }}" class="option-btn">Update</a>
                            <a href="{{ route('delete.order', $order->id) }}" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
                        </div>
                    </form>
                </div>
            @endforeach
        @else
            <p class="empty">No orders placed yet!</p>
        @endif

    </div>

</section>
@endsection
