<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
   <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>

    @include('auth.admin_header')

    

    <section class="dashboard">
        <h1 class="heading">Dashboard</h1>
        
        <div class="box-container">

            <div class="box">
                <h3>Welcome!</h3>
                <p>{{ Session::get('admin_name') }}</p>
                <a href="{{ route('auth.updateProfile') }}" class="btn">Update Profile</a>
            </div>

            <div class="box">
                <h3><span>$</span>{{ $totalPendings }}<span>/-</span></h3>
                <p>Total Pendings</p>
                <a href="{{ route('auth.order') }}" class="btn">See Orders</a>
            </div>

            <div class="box">
                <h3><span>$</span>{{ $totalCompletes }}<span>/-</span></h3>
                <p>Doanh thu</p>
                <a href="{{ route('admin.revenueChart') }}" class="btn">See Orders</a>
            </div>

            <div class="box">
                <h3>{{ $numberOfOrders }}</h3>
                <p>Orders Placed</p>
                <a href="{{ route('placed-orders') }}" class="btn">See Orders</a>
            </div>

            <div class="box">
                <h3>{{ $numberOfProducts }}</h3>
                <p>Products Added</p>
                <a href="{{ route('auth.index') }}" class="btn">See Products</a>
            </div>

            <div class="box">
                <h3>{{ $numberOfUsers }}</h3>
                <p>Normal Users</p>
                <a href="{{ route('users.accounts') }}" class="btn">See Users</a>
            </div>

            <div class="box">
                <h3>{{ $numberOfAdmins }}</h3>
                <p>Admin Users</p>
                <a href="{{ route('admin.accounts') }}" class="btn">See Admins</a>
            </div>

            <div class="box">
                <h3>{{ $numberOfMessages }}</h3>
                <p>New Messages</p>
                <a href="{{ route('messages.index') }}" class="btn">See Messages</a>
            </div>

        </div>

    </section>

    <script src="{{ asset('js/admin_script.js') }}"></script>

</body>
</html>
