<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>

@include('auth.admin_header')

<section class="contacts">
    <h1 class="heading">Messages</h1>
    <div class="box-container">
        @if($messages->isNotEmpty())
            @foreach($messages as $message)
                <div class="box">
                    <p> Name: <span>{{ $message->name }}</span></p>
                    <p> Email: <span>{{ $message->email }}</span></p>
                    <p> Number: <span>{{ $message->number }}</span></p>
                    <p> Message: <span>{{ $message->message }}</span></p>
                    <a href="{{ route('messages.delete', $message->id) }}" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
                </div>
            @endforeach
        @else
            <p class="empty">You have no messages</p>
        @endif
    </div>
</section>

<script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
