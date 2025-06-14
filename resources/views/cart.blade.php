<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" sizes="32x32" href="/img/white-logo.png">
        <link rel="stylesheet" href="/css/navbar.css" />
        <link rel="stylesheet" href="/css/footer.css">
        <link rel="stylesheet" href="/css/sidebar.css">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="stylesheet" href="/css/cart.css">
        <link
            href="https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&family=Cairo:wght@200..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <title>Cart</title>

</head>
<body>
    <x-navbar 
    :categories="$categories"
    cartQuantity="{{$cartQuantity}}"
    />
    <section class="cart-page">
    <div class="cart-container">
        <h2>Shopping Cart</h2>
        @if ($products->count()>0)
               <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th></th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price ($)</th>
                </tr>
            </thead>
            <tbody id="cart-body">
                @php
                $totalPrice = 0; // Initialize total price variable
                @endphp
                <form method="post" action="/checkout">
                @csrf
                @foreach ($products as $index=>$item)
                <tr>
                    <input type="hidden" value="{{$item->id}}" name="item_{{$item->id}}">
                    <td>{{$index + 1}}</td>
                    <td><img src="/storage/products/{{$item->image}}" alt="{{$item->name}}" loading="lazy"></td>
                    <td>{{$item->name}}</td>
                    <td>
                        <div class="quantity-controls">
                            <button type="button" class="quantity-btn" onclick="updateQuantity({{$item->id}}, -1,{{$item->price}})">-</button>
                            <input readonly type="text" class="item-quantity" name="quantity_{{$item->id}}" value="{{$cart[$index]['quantity']}}" id="quantity-{{$item->id}}" />
                            <button  type="button" class="quantity-btn" onclick="updateQuantity({{$item->id}}, 1,{{$item->price}})">+</button>
                        </div>
                    </td>
                    <td id="price-{{$item->id}}">{{$item->price*$cart[$index]['quantity']}}</td>
                </tr>
                @php
                    $subtotal = $cart[$index]['quantity'] * $item->price;// Calculate subtotal for this book
                    $totalPrice += $subtotal;// Add subtotal to total price
                    @endphp
                @endforeach
            
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="4">Total Price</td>
                    <td id="total-price">${{number_format($totalPrice, 2)}}</td>
                </tr>
            </tfoot>
        </table>
        <button class="checkout-btn" type="submit">Proceed to Checkout</button>
    </form>
    
    @else
    <h2 class="empty-cart">You cart is empty</h2>
        @endif
       
    </div>
</section>
   <x-footer :categories="$categories"/>
    <script>

        function updateQuantity(itemId, change, price) {
            let itemQuantity=document.getElementById("quantity-"+itemId).value;  
            let totalPriceElement = document.getElementById("total-price");
            let totalPrice = 0;
            let newPrice=0;
            if(change==1){
                itemQuantity++;
                newPrice=price*itemQuantity;
            }else if(change==-1){
                itemQuantity--;
                if(itemQuantity<0){
                itemQuantity=0;
            }
            newPrice=price*itemQuantity;
            }
            
            document.getElementById("price-"+itemId).textContent=newPrice.toFixed(2);
            document.getElementById("quantity-"+itemId).value=itemQuantity;
            document.querySelectorAll("[id^='price-']").forEach(priceEl => {
            totalPrice += parseFloat(priceEl.textContent);
            });
            totalPriceElement.textContent = `$${totalPrice.toFixed(2)}`;
        }

    </script>
    <script src="/js/navbar.js"></script>
</body>
</html>