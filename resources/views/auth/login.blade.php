<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>

@if ($errors->any())
    <div class="message">
        <span>{{ $errors->first() }}</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
    </div>
@endif

<div class="tong">
    <section class="form-container">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h3>Login Now</h3>
            <input type="text" name="name" required placeholder="Enter your username" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="password" name="pass" required placeholder="Enter your password" maxlength="20" class="box" oninput="this.value = this.value.replace(/\s/g, '')">
            <input type="submit" value="Login Now" class="btn">

            <p>Or</p>
    
            <a href="{{ route('login.facebook') }}" class="btn"><i class="fab fa-facebook"></i> Login with Facebook</a>
            <a href="{{ route('login.google') }}" class="btn"><i class="fab fa-google"></i> Login with Google</a>
        </form>
    </section>
</div>

</body>
</html>
