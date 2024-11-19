<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<section class="orders">
    <h1 class="heading">Placed Orders</h1>

    <div class="box-container">
        @if($orders->isEmpty())
            <p class="empty">No orders placed yet!</p>
        @else
            @foreach($orders as $order)
            <div class="box">
                <p>Placed on: <span>{{ $order->created_at->format('d M, Y') }}</span></p>
                <p>Name: <span>{{ $order->name }}</span></p>
                <p>Email: <span>{{ $order->email }}</span></p>
                <p>Number: <span>{{ $order->number }}</span></p>
                <p>Address: <span>{{ $order->address }}</span></p>
                <p>Payment Method: <span>{{ $order->method }}</span></p>
                <p>Your Orders: <span>{{ $order->total_products }}</span></p>
                <p>Total Price: <span>${{ $order->total_price }}</span></p>
                <p>Payment Status: 
                    <span style="color: {{ $order->payment_status == 'pending' ? 'red' : 'green' }}">
                        {{ $order->payment_status }}
                    </span>
                </p>
            </div>
            @endforeach
        @endif
    </div>
</section>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
