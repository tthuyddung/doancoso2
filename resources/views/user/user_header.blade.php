<header class="header">
   <section class="flex">
   <a href="{{ route('home') }}" class="logo">
         <img src="{{ asset('images/logo.png') }}" alt="Admin Panel Logo">
      </a>

      <nav class="navbar">
         <a href="{{ route('home') }}">TRANG CHỦ</a>
         <a href="{{ route('about') }}">NỘI DUNG</a>
         <a href="{{route('user.orders')}}">HÓA ĐƠN</a>
         <a href="{{ route('shop') }}">CỬA HÀNG</a>
         <a href="{{route('contact')}}">LIÊN HỆ</a>
      </nav>

      <div class="icons">
   @php
      $cart_count = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->count() : 0;
      $wishlist_count = Auth::check() ? \App\Models\Wishlist::where('user_id', Auth::id())->count() : 0;
   @endphp
   <div id="menu-btn" class="fas fa-bars"></div>
   <a href="{{ route('search') }}"><i class="fas fa-search"></i></a>
   <a href="{{ route('cart.index') }}" class="cart-icon">
      <i class="fas fa-shopping-cart"></i>
      @if($cart_count > 0)
         <span class="cart-count">{{ $cart_count }}</span>
      @endif
   </a>
   <a href="{{ route('wishlist.index') }}" class="wishlist-icon">
      <i class="fas fa-heart"></i>
      @if($wishlist_count > 0)
         <span class="wishlist-count">{{ $wishlist_count }}</span>
      @endif
   </a>
   <div id="user-btn" class="fas fa-user"></div>
</div>


      <div class="profile">
      @if(Auth::check()) 
         <p>{{ Auth::user()->name }}</p>
         <a href="{{ route('profile.edit') }}" class="btn">Cập nhật</a>
         <div class="flex-btn">
               <a href="{{ route('register') }}" class="option-btn">Đăng kí</a>
               <a href="{{ route('dangnhap') }}" class="option-btn">Đăng nhập</a>
         </div>
         <form action="{{ route('dangxuat') }}" method="post" style="display: inline;">
               @csrf
               <button type="submit" class="btn btn-danger">Đăng xuất</button>
         </form>
      @else
         <p>Vui lòng đăng nhập hoặc đăng kí!</p>
         <div class="flex-btn">
               <a href="{{ route('register') }}" class="option-btn">Đăng kí</a>
               <a href="{{ route('dangnhap') }}" class="option-btn">Đăng nhập</a>
         </div>
      @endif
   </div>

   </section>
</header>
