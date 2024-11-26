@extends('layouts.on')

@section('content')
<div class="container">
    <h3>Order Success</h3>
    <p>Your order has been placed successfully! Thank you for your purchase.</p>
    <a href="{{ route('home') }}" class="btn">Go to Home</a>
</div>
@endsection
