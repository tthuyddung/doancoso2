@extends('layouts.app')

@section('content')
<section class="accounts">
   <h1 class="heading">User Accounts</h1>
   <div class="box-container">
       @if($users->isEmpty())
           <p class="empty">No accounts available!</p>
       @else
           @foreach($users as $user)
               <div class="box">
                   <p> User ID: <span>{{ $user->id }}</span> </p>
                   <p> Username: <span>{{ $user->name }}</span> </p>
                   <p> Email: <span>{{ $user->email }}</span> </p>
                   <form action="{{ route('users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Delete this account? All related information will also be deleted!')">
                       @csrf
                       @method('DELETE')
                       <button type="submit" class="delete-btn">Delete</button>
                   </form>
               </div>
           @endforeach
       @endif
   </div>
</section>
@endsection
