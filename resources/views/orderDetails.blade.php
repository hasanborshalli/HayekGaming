<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="icon" sizes="32x32" href="/img/white-logo.svg">
    <link
        href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/orderDetails.css">
</head>

<body>

    <x-navigator />

    <!-- Main Content -->
    <div class="main-content">
        <!-- Order Details Section -->
        <div id="order-details">
            <h1>Order Details</h1>

            <div class="order-info">
                <h2>Customer Information</h2>
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Mobile Number:</strong> {{ $order->mobile }}</p>
                <p><strong>Second Mobile Number:</strong> {{ $order->second_mobile }}</p>
                <p><strong>City:</strong> {{ $order->city }}</p>
                <p><strong>Street:</strong> {{ $order->street }}</p>
                <p><strong>Building:</strong> {{ $order->building }}</p>
                <p><strong>Floor:</strong> {{ $order->floor }}</p>
                <p><strong>Remarks:</strong> {{ $order->remarks ?? 'No remarks' }}</p>
            </div>

            <div class="order-summary">
                <h2>Order Summary</h2>
                <p><strong>Total Price:</strong> ${{ number_format($order->total, 2) }}</p>
                <p><strong>Ordered on:</strong> {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
            </div>

            <div class="order-items">
                <h2>Order Items</h2>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price per Unit</th>
                                <th>Total Price</th>
                                <th>Product Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price, 2) }}</td>
                                <td>${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                <td><img src="/storage/products/{{ $item->product->image }}" alt="Product Image"
                                        style="max-width: 100px; height: auto;"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="/finishOrder/{{$order->id}}"> <button id="mark-done-btn">Mark as Done</button></a>
        </div>
    </div>

</body>

</html>