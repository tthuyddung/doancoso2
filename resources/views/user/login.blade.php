@extends('layouts.on')

@section('content')
<div class="tong">
   <section class="form-container">
      <form action="{{ route('dangnhap') }}" method="POST">
         @csrf
         <h3>login now</h3>
         <input type="email" name="email" required placeholder="enter your email" maxlength="50" class="box" value="{{ old('email') }}">
         @error('email')
            <div class="text-danger">{{ $message }}</div>
         @enderror
         <input type="password" name="password" required placeholder="enter your password" maxlength="20" class="box">
         @error('password')
            <div class="text-danger">{{ $message }}</div>
         @enderror
         <input type="submit" value="login now" class="btn">
         <p>don't have an account?</p>
         <a href="{{ route('register') }}" class="option-btn">register now</a>

         <!-- Buttons for social login -->
         <a href="{{ route('login.facebook') }}" class="btn"><i class="fab fa-facebook"></i> Login with Facebook</a>
            <a href="{{ route('login.google') }}" class="btn"><i class="fab fa-google"></i> Login with Google</a>
      </form>
   </section>
</div>
@endsection
