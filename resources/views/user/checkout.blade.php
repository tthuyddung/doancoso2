<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<section class="checkout-orders">
    <form action="{{ route('place.order') }}" method="POST">
        @csrf
        <h3>Your Orders</h3>
        
        <div class="display-orders">
            <input type="hidden" name="total_products" value="">
            <input type="hidden" name="total_price" value="0">
            <div class="grand-total">Grand Total: <span>$0</span></div>
        </div>

        <h3>Place Your Orders</h3>
        <div class="flex">
            <div class="inputBox">
                <span>Your Name:</span>
                <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
                <span>Your Number:</span>
                <input type="number" name="number" placeholder="Enter your number" class="box" required>
            </div>
            <div class="inputBox">
                <span>Your Email:</span>
                <input type="email" name="email" placeholder="Enter your email" class="box" required>
            </div>
            <div class="inputBox">
                <span>Payment Method:</span>
                <select name="method" class="box" required>
                    <option value="cash on delivery">Cash on Delivery</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Flat No:</span>
                <input type="text" name="flat" placeholder="Flat number" class="box" required>
            </div>
            <div class="inputBox">
                <span>Street:</span>
                <input type="text" name="street" placeholder="Street name" class="box" required>
            </div>
            <div class="inputBox">
                <span>City:</span>
                <input type="text" name="city" placeholder="City" class="box" required>
            </div>
            <div class="inputBox">
                <span>State:</span>
                <input type="text" name="state" placeholder="State" class="box" required>
            </div>
            <div class="inputBox">
                <span>Country:</span>
                <input type="text" name="country" placeholder="Country" class="box" required>
            </div>
            <div class="inputBox">
                <span>Pin Code:</span>
                <input type="number" name="pin_code" placeholder="Pin Code" class="box" required>
            </div>
        </div>
        
        <input type="submit" value="Place Order" class="btn">
    </form>
</section>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
