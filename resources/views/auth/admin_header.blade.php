<header class="header">
   <section class="flex">
      <a href="{{ route('auth.dashboard') }}" class="logo">
         <img src="{{ asset('images/TALL.png') }}" alt="Admin Panel Logo">
      </a>

      <nav class="navbar">
         <a href="{{ route('auth.dashboard') }}">HOME</a>
         <a href="{{ route('auth.index') }}">PRODUCTS</a>
         <a href="{{ route('auth.order') }}">ORDER</a>
         <a href="{{ route('admin.accounts') }}">ADMINS</a>
         <a href="{{ route('users.accounts') }}">USERS</a>
         <a href="{{ route('messages.index') }}">MESSAGE</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
    @if(isset($profile) && $profile)
        <p>{{ $profile->name }}</p>
        <a href="{{ url('/auth/update_profile') }}" class="btn">update profile</a>
        <div class="flex-btn">
            <a href="{{ url('/auth/register_admin') }}" class="option-btn">register</a>
            <a href="{{ url('/auth/login') }}" class="option-btn">login</a>
        </div>
        <a href="{{ route('logout') }}" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
    @endif
</div>
   </section>
</header>
