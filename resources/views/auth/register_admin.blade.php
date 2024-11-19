<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>

<div class="tong">
    <section class="form-container">
        @if(session('success'))
            <div class="no-style">{{ session('success') }}</div> <!-- Thêm lớp no-style -->
        @endif
    
        @if($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('auth.register_admin.action') }}" method="post">
            @csrf
            <h3>Register Now</h3>
            <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="cpass" required placeholder="Confirm your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Register Now" class="btn">
            <p>Already have an account?</p>
            <a href="{{ route('login') }}" class="btn">Login</a>
    
            <p>Or</p>
    
            <a href="{{ route('login.facebook') }}" class="btn"><i class="fab fa-facebook"></i> Login with Facebook</a>
            <a href="{{ route('login.google') }}" class="btn"><i class="fab fa-google"></i> Login with Google</a>
        </form>
    </section>
</div>

<script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
