@extends('layouts.app')

@section('content')
<section class="register-admin">

    <h1 class="heading">Register New Admin</h1>

    <form action="{{ route('admin.accounts.store') }}" method="POST">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Register Admin" class="option-btn">
    </form>

</section>
@endsection
