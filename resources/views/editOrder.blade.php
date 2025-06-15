<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="32x32" href="/img/white-logo.webp">
    <link
        href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <title>Edit Order</title>
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/editOrder.css">
</head>

<body>

    <x-navigator />
    <section class="addProduct-page">
        <h1 class="page-title">Edit Order</h1>

        <form action="/order/edit/{{$order->id}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="name" value="{{ old('name', $order->name) }}" required>
                @error('name')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <!-- Customer Mobile -->
            <div class="form-group">
                <label for="customer-mobile">Mobile Number</label>
                <input type="text" id="customer-mobile" name="mobile" value="{{ old('mobile', $order->mobile) }}"
                    required>
                @error('mobile')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <!-- Customer Address -->
            <div class="form-group">
                <label for="customer-address">City</label>
                <input type="text" id="customer-address" name="city" value="{{ old('city', $order->city) }}" required>
                @error('city')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer-address">Street</label>
                <input type="text" id="customer-address" name="street" value="{{ old('street', $order->street) }}">
                @error('street')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer-address">Building</label>
                <input type="text" id="customer-address" name="building"
                    value="{{ old('building', $order->building) }}">
                @error('building')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="customer-address">Floor</label>
                <input type="text" id="customer-address" name="floor" value="{{ old('floor', $order->floor) }}">
                @error('floor')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <!-- Remarks -->
            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks">{{ old('remarks', $order->remarks) }}</textarea>
                @error('remarks')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>

            <!-- Order Items -->
            <br>
            <hr>
            <br>
            <div class="form-group">
                <label for="order-items">Order Items</label>
                <div class="order-items">
                    @foreach ($order->products as $index => $item)
                    <div class="order-item">
                        <p class="input-label"><strong>{{ $item->product->name }}</strong></p>
                        <div class="quantity-controls">
                            <input type="number" class="item-quantity" name="quantity_{{$item->product->id}}"
                                value="{{$item->quantity}}" id="quantity-{{$item->product->id}}" min="0"
                                data-price="{{ $item->product->price }}" data-id="{{ $item->product->id }}" />
                        </div>
                        <input type="hidden" name="item_{{$item->product->id}}" value="{{ $item->product->id }}">
                        <p id="item-price-{{$item->product->id}}">Price: ${{ $item->product->price * $item->quantity }}
                        </p> <!-- Initial price for the item -->
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Order Price -->
            <div class="form-group">
                <label for="total-price">Total Order Price</label>
                <input type="number" readonly id="total-price" name="total" value="{{ old('total', $order->total) }}"
                    readonly>
                @error('total')
                <p style="color:red">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="submit-btn">Save Changes</button>
            </div>
        </form>
    </section>
    <script>
        function updateTotalPrice() {
        let totalPrice = 0;

        // Loop through all items and update their price
        document.querySelectorAll('.item-quantity').forEach(function(input) {
            const quantity = input.value;
            const pricePerItem = input.getAttribute('data-price');
            const itemId = input.getAttribute('data-id');
            const itemTotalPrice = quantity * pricePerItem;

            // Update item price display
            document.getElementById('item-price-' + itemId).innerText = "Price: $" + itemTotalPrice;

            // Add the item price to the total order price
            totalPrice += itemTotalPrice;
        });

        // Update the total order price
        document.getElementById('total-price').value = totalPrice;
    }

    // Add event listener for quantity change
    document.querySelectorAll('.item-quantity').forEach(function(input) {
        input.addEventListener('input', function() {
            updateTotalPrice();
        });
    });

    // Initial call to set the total price when the page loads
    updateTotalPrice();
    </script>
</body>

</html>