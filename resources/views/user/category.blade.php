@extends('layouts.on')

@section('content')
<section class="products">
    <h1 class="heading">Category: {{ $category }}</h1>

    <div class="box-container">
        @if($products->count() > 0)
            @foreach($products as $product)
                <div class="box">
                    <a href="{{ url('quick_view', ['pid' => $product->id]) }}" class="fas fa-eye"></a>
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="name">{{ $product->name }}</div>
                    <div class="flex">
                        <div class="price"><span>$</span>{{ $product->price }}<span>/-</span></div>
                    </div>
                </div>
            @endforeach
        @else
            <p class="empty">No products found!</p>
        @endif
    </div>
</section>
@endsection
