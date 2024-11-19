@extends('layouts.on')

@section('content')
<section class="form-container">
   <form action="{{ route('register') }}" method="POST">
      @csrf
      <h3>Register now</h3>
      <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="box" value="{{ old('name') }}">
      @error('name')
         <div class="text-danger">{{ $message }}</div>
      @enderror

      <input type="email" name="email" required placeholder="Enter your email" maxlength="50" class="box" value="{{ old('email') }}">
      @error('email')
         <div class="text-danger">{{ $message }}</div>
      @enderror

      <input type="password" name="password" required placeholder="Enter your password" maxlength="20" class="box">
      @error('password')
         <div class="text-danger">{{ $message }}</div>
      @enderror

      <input type="password" name="password_confirmation" required placeholder="Confirm your password" maxlength="20" class="box">
      @error('password_confirmation')
         <div class="text-danger">{{ $message }}</div>
      @enderror

      <input type="submit" value="Register now" class="btn">
      <p>Already have an account?</p>
      <a href="{{ route('login') }}" class="option-btn">Login now</a>
   </form>
</section>
@endsection
