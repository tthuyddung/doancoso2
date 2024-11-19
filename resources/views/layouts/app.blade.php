<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/admin_script.js') }}"></script>
</body>
</html>
