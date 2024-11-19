<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<section class="search-form">
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="search_box" placeholder="search here..." maxlength="100" class="box" required>
        <button type="submit" class="fas fa-search" name="search_btn"></button>
    </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">
    <h2 class="heading">Search Results</h2>
    <div class="box-container">
        @if(isset($products) && count($products) > 0)
            @foreach($products as $product)
                <form class="box">
                    <!-- Nút xem nhanh -->
                    <a href="{{ url('quick_view', $product->id) }}" class="fas fa-eye"></a>
                    
                    <!-- Hình ảnh sản phẩm -->
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    
                    <!-- Tên sản phẩm -->
                    <div class="name">{{ $product->name }}</div>
                    
                    <!-- Giá và số lượng -->
                    <div class="flex">
                        <div class="price"><span>$</span>{{ $product->price }}<span>/-</span></div>
                    </div>
                </form>
            @endforeach
        @else
            <p class="empty">No products found!</p>
        @endif
    </div>
</section>

<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
