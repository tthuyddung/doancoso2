@extends('layouts.app')

@section('content')
<section class="accounts">

    <h1 class="heading">Admin Accounts</h1>

    @if(session('message'))
        <p class="message">{{ session('message') }}</p>
    @endif

    <div class="box-container">

        <div class="box">
            <p>Add New Admin</p>
            <a href="{{ route('auth.register_admin') }}" class="option-btn">Register Admin</a>
        </div>

        @if($admins->isNotEmpty())
        @foreach($admins as $admin)
    <div class="box">
        <p>Admin ID: <span>{{ $admin->id }}</span></p>
        <p>Admin Name: <span>{{ $admin->name }}</span></p>
        <p>Auth ID: <span>{{ Auth::guard('admin')->id() }}</span></p>
        @if (Auth::guard('admin')->check())
            <p>Đã đăng nhập</p>
        @else
            <p>Chưa đăng nhập</p>
        @endif

        <div class="flex-btn">
            <a href="{{ route('admin.accounts.delete', $admin->id) }}" onclick="return confirm('Delete this account?')" class="delete-btn">Delete</a>
            <a href="{{ route('auth.updateProfile', $admin->id) }}" class="option-btn">Cập nhật</a>
        </div>
    </div>
@endforeach

        @else
            <p class="empty">No accounts available!</p>
        @endif

    </div>

</section>
@endsection
