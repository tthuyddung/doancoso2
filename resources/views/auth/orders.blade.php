<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders List</title>
    <link rel="stylesheet" href="{{ asset('css/admins.css') }}">
</head>
<body>

<h1>Orders List</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Total Price</th>
            <th>Payment Status</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
