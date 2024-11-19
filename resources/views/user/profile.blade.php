@extends('layouts.on')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="old_pass">Old Password</label>
                            <input type="password" name="old_pass" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_pass">New Password</label>
                            <input type="password" name="new_pass" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="cpass">Confirm New Password</label>
                            <input type="password" name="cpass" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
