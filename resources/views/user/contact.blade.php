<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

@include('user.user_header')

<section class="contact">
    @if(session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <form action="{{ url('/contact') }}" method="post">
        @csrf
        <h3>Get in touch</h3>
        <input type="text" name="name" placeholder="Enter your name" required maxlength="20" class="box">
        <input type="email" name="email" placeholder="Enter your email" required maxlength="50" class="box">
        <input type="number" name="number" min="0" max="9999999999" placeholder="Enter your number" required class="box">
        <textarea name="msg" class="box" placeholder="Enter your message" cols="30" rows="10" required></textarea>
        <input type="submit" value="Send Message" class="btn">
    </form>
</section>



<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
