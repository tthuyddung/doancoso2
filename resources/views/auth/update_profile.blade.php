<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>


@if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

@if(session('message'))
    <div class="message">
        <span>{{ session('message') }}</span>
        <i class="fas fa-times" onclick="this.parentElement.style.display='none';"></i>
    </div>
@endif

<section class="form-container">
    <form action="{{ route('auth.updateProfile') }}" method="post">
        @csrf
        <h3>Update Profile</h3>
        <input type="text" name="name" value="{{ old('name', $admin->name ?? '') }}" required placeholder="Enter your username" maxlength="20" class="box">
        
        <input type="password" name="old_pass" placeholder="Enter old password" maxlength="20" class="box">
        
        <input type="password" name="new_pass" placeholder="Enter new password" maxlength="20" class="box">
        
        <input type="password" name="new_pass_confirmation" placeholder="Confirm new password" maxlength="20" class="box">
        
        <input type="submit" value="Update Now" class="btn" name="submit">
        
        @if($errors->any())
            <div class="alert alert-danger">
                {{ implode('', $errors->all(':message')) }}
            </div>
        @endif
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
    </form>
</section>


<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
