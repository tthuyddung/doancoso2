<header class="header">
   <section class="flex">
   <a href="{{ route('home') }}" class="logo">
         <img src="{{ asset('images/TALL.png') }}" alt="Admin Panel Logo">
      </a>

      <nav class="navbar">
         <a href="{{ route('home') }}">home</a>
         <a href="{{ route('about') }}">about</a>
         <a href="{{route('user.orders')}}">order</a>
         <a href="{{ route('shop') }}">shop</a>
         <a href="{{route('contact')}}">contact</a>
      </nav>

      <div class="icons">
      @php
         $cart_count = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->count() : 0;
      @endphp
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="{{ route('search') }}"><i class="fas fa-search"></i></a>
         <a href="{{ route('cart.index') }}" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            @if($cart_count > 0)
                  <span class="cart-count">{{ $cart_count }}</span>
            @endif
         </a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
      @if(Auth::check()) <!-- Kiểm tra người dùng đã đăng nhập chưa -->
         <p>{{ Auth::user()->name }}</p>
         <a href="{{ route('profile.edit') }}" class="btn">Update Profile</a>
         <div class="flex-btn">
               <a href="{{ route('register') }}" class="option-btn">Register</a>
               <a href="{{ route('dangnhap') }}" class="option-btn">Login</a>
         </div>
         <form action="{{ route('dangxuat') }}" method="post" style="display: inline;">
               @csrf
               <button type="submit" class="btn btn-danger">Logout</button>
         </form>
      @else
         <p>Please login or register first!</p>
         <div class="flex-btn">
               <a href="{{ route('register') }}" class="option-btn">Register</a>
               <a href="{{ route('dangnhap') }}" class="option-btn">Login</a>
         </div>
      @endif
   </div>

   </section>
</header>
